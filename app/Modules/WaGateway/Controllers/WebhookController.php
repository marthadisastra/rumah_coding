<?php

namespace Modules\WaGateway\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

/**
 * WebhookController
 * 
 * Bertugas menangkap seluruh event Webhook yang dikirim oleh Evolution API.
 */
class WebhookController extends BaseController
{
    use ResponseTrait;

    public function evolution()
    {
        // 1. Tangkap Payload JSON dari Evolution API
        $json = $this->request->getJSON(true);

        if (!$json) {
            return $this->fail('Invalid payload');
        }

        $event = $json['event'] ?? '';
        $instanceName = $json['instance'] ?? '';
        $data = $json['data'] ?? [];

        // 2. Routing berdasarkan Tipe Event
        switch ($event) {
            case 'connection.update':
                $this->handleConnectionUpdate($instanceName, $data);
                break;
            
            case 'messages.upsert':
                $this->handleMessageUpsert($instanceName, $data);
                break;
        }

        // 3. Selalu reply 200 OK agar Evolution tidak melakukan retry terus-menerus
        return $this->respond(['status' => 'success']);
    }

    /**
     * Menangani update koneksi (Contoh: user scan QR, HP mati, dll)
     */
    private function handleConnectionUpdate(string $instanceName, array $data)
    {
        $state = $data['state'] ?? '';
        
        $statusMapping = [
            'open'       => 'open',
            'close'      => 'close',
            'connecting' => 'connecting',
            // Evolution kadang mengirim payload qrcode
        ];

        // Jika QR Code diterima dari payload state
        if (isset($data['qrcode']) && !empty($data['qrcode'])) {
            $this->updateInstanceStatus($instanceName, 'qrcode');
            return;
        }

        if (array_key_exists($state, $statusMapping)) {
            $this->updateInstanceStatus($instanceName, $statusMapping[$state]);
        }
    }

    /**
     * Memperbarui status koneksi instance di database MySQL
     */
    private function updateInstanceStatus(string $instanceName, string $status)
    {
        $db = \Config\Database::connect();
        $db->table('wa_instances')
           ->where('instance_name', $instanceName)
           ->update([
               'connection_status' => $status, 
               'updated_at' => date('Y-m-d H:i:s')
           ]);
    }

    /**
     * Menangani pesan masuk (Untuk Webhook & Auto-Responder)
     */
    private function handleMessageUpsert(string $instanceName, array $data)
    {
        $message = $data['messages'][0] ?? [];
        if (empty($message)) return;

        // Abaikan jika pesan tersebut adalah pesan yang dikirim oleh sistem sendiri
        $isFromMe = $message['key']['fromMe'] ?? false;
        if ($isFromMe) return;

        $remoteJid = $message['key']['remoteJid'] ?? '';
        $conversation = $message['message']['conversation'] ?? ''; // Teks pesan
        // Note: di Evolution bisa juga extendedTextMessage dll, ini versi basic

        // TODO: Anda bisa menambahkan logic Auto-Responder di sini
        // $this->checkAutoResponder($instanceName, $remoteJid, $conversation);

        // Debug logging
        log_message('info', "[Webhook] Incoming Message on [$instanceName] from $remoteJid: $conversation");
    }
}
