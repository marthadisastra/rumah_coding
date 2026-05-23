<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWaInstancesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tenant_id' => [
                'type'       => 'BIGINT',
                'unsigned'   => true,
            ],
            'instance_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true,
            ],
            'instance_token' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'phone_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null'       => true,
            ],
            'connection_status' => [
                'type'       => 'ENUM',
                'constraint' => ['connecting', 'open', 'close', 'qrcode'],
                'default'    => 'close',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        
        $this->forge->addForeignKey('tenant_id', 'tenants', 'id', 'CASCADE', 'CASCADE');
        
        $this->forge->addKey('tenant_id');
        $this->forge->addKey('connection_status');

        $this->forge->createTable('wa_instances');
    }

    public function down()
    {
        $this->forge->dropTable('wa_instances');
    }
}
