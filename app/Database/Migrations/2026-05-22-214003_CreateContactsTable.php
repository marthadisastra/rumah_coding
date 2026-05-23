<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContactsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'tenant_id'      => ['type' => 'BIGINT', 'unsigned' => true],
            'contact_name'   => ['type' => 'VARCHAR', 'constraint' => '150'],
            'phone_number'   => ['type' => 'VARCHAR', 'constraint' => '25'],
            'tags'           => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('tenant_id', 'tenants', 'id', 'CASCADE', 'CASCADE');
        
        $this->forge->addKey(['tenant_id', 'phone_number']);
        
        $this->forge->createTable('contacts');
    }

    public function down()
    {
        $this->forge->dropTable('contacts');
    }
}
