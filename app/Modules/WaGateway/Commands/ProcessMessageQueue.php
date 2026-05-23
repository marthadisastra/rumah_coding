<?php

namespace Modules\WaGateway\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Modules\WaGateway\Services\EvolutionApiService;

class ProcessMessageQueue extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'WaGateway';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'wage:process_queue';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Mengeksekusi antrean pesan WhatsApp (status pending) ke Evolution API.';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'wage:process_queue [limit]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [
        'limit' => 'Jumlah pesan minimum yang dieksekusi dalam satu batch (default 50)',
    ];

    public function run(array $params)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('message_queues');
        
        $limit = $params[0] ?? 50;

        CLI::write("Mencari antrean pesan dengan status 'pending'...", 'yellow');

        // Optimasi: Hanya ambil pesan berstatus pending yang jadwalnya (scheduled_at) sudah masuk atau (NULL)
        $builder->where('status', 'pending');
        $builder->groupStart()
                ->where('scheduled_at <=', date('Y-m-d H:i:s'))
                ->orWhere('scheduled_at IS NULL')
                ->groupEnd();
        
        // Lakukan join dengan tabel wa_instances untuk mendapatkan instance_name dari device tersebut
        $builder->select('message_queues.*, wa_instances.instance_name');
        $builder->join('wa_instances', 'wa_instances.id = message_queues.wa_instance_id', 'left');
        
        $builder->limit((int)$limit);
        $builder->orderBy('id', 'ASC'); // Konsep FIFO (First In First Out) queue

        $pendingMessages = $builder->get()->getResult();

        if (empty($pendingMessages)) {
            CLI::write('Tidak ada antrean pesan yang perlu diproses saat ini.', 'green');
            return;
        }

        CLI::write('Ditemukan ' . count($pendingMessages) . ' pesan. Memulai proses antrean...', 'green');

        // Inisialisasi Service Evolution API
        $evolutionApi = new EvolutionApiService();

        foreach ($pendingMessages as $msg) {
            CLI::write("Memroses Queue ID {$msg->id} tujuan -> {$msg->receiver_number}...");

            // 1. Kunci status pesan menjadi "processing" untuk menghindari double-send (jika ada lebih dari 1 cron berjalan)
            $db->table('message_queues')->where('id', $msg->id)->update([
                'status'     => 'processing',
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // Ambil text body payload (Format JSON yang disediakan di tabel saat blast)
            $payload = json_decode($msg->message_payload, true);
            $text = $payload['text'] ?? '';

            // Apabila instance hilang atau belum disambungkan
            if (empty($msg->instance_name)) {
                $db->table('message_queues')->where('id', $msg->id)->update([
                    'status'       => 'failed',
                    'error_reason' => 'Instance Code tidak ditemukan di database.',
                    'updated_at'   => date('Y-m-d H:i:s')
                ]);
                CLI::write("-> Gagal: Instance Code tidak ditemukan.", 'red');
                continue;
            }

            // 2. Tembakkan service Evolution API
            $response = $evolutionApi->sendText($msg->instance_name, $msg->receiver_number, $text);

            // 3. Validasi hasil dan perbarui Database Queue
            if (isset($response['key']['id']) || (isset($response['status']) && $response['status'] !== 'ERROR' && isset($response['messageId']))) {
                $db->table('message_queues')->where('id', $msg->id)->update([
                    'status'     => 'sent',
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                CLI::write("-> Sukses!", 'green');
            } else {
                $errorMsg = $response['message'] ?? json_encode($response);
                $db->table('message_queues')->where('id', $msg->id)->update([
                    'status'       => 'failed',
                    'error_reason' => mb_substr($errorMsg, 0, 250), // Truncate untuk mencegah error length string
                    'updated_at'   => date('Y-m-d H:i:s')
                ]);
                CLI::write("-> Gagal (" . $errorMsg . ")", 'red');
            }

            // Beri jeda 1 detik tiap pengiriman pesan agar terhindar dari pemblokiran rate limit evolution
            usleep(1000000); 
        }

        CLI::write('Selesai.', 'cyan');
    }
}
