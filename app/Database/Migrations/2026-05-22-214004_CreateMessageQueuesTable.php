<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMessageQueuesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'tenant_id'      => ['type' => 'BIGINT', 'unsigned' => true],
            'wa_instance_id' => ['type' => 'BIGINT', 'unsigned' => true],
            'receiver_number'=> ['type' => 'VARCHAR', 'constraint' => '25'],
            'message_payload'=> ['type' => 'JSON', 'null' => true],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'processing', 'sent', 'failed'],
                'default'    => 'pending',
            ],
            'scheduled_at'   => ['type' => 'DATETIME', 'null' => true],
            'error_reason'   => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('tenant_id', 'tenants', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('wa_instance_id', 'wa_instances', 'id', 'CASCADE', 'CASCADE');

        $this->forge->addKey(['status', 'scheduled_at']);
        $this->forge->addKey('tenant_id');
        
        $this->forge->createTable('message_queues');
    }

    public function down()
    {
        $this->forge->dropTable('message_queues');
    }
}
