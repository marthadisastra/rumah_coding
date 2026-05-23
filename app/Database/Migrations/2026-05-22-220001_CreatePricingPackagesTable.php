<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePricingPackagesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'name'        => ['type' => 'VARCHAR', 'constraint' => 100],  // Nama paket: Free, Personal, Bisnis, Enterprise
            'slug'        => ['type' => 'VARCHAR', 'constraint' => 50],   // free | personal | bisnis | enterprise
            'price'       => ['type' => 'INT', 'unsigned' => true],       // Harga per bulan dalam Rupiah
            'max_instances'     => ['type' => 'INT', 'unsigned' => true], // Maks jumlah WA Instance
            'max_messages'      => ['type' => 'INT', 'unsigned' => true], // Kuota pesan per bulan
            'max_portfolios'    => ['type' => 'INT'],                     // -1 = unlimited
            'features'          => ['type' => 'TEXT', 'null' => true],    // JSON array fitur yang tersedia
            'is_recommended'    => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'is_dark_card'      => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'sort_order'        => ['type' => 'INT', 'default' => 0],
            'is_active'         => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at'        => ['type' => 'DATETIME', 'null' => true],
            'updated_at'        => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('slug');
        $this->forge->addKey('is_active');
        $this->forge->createTable('pricing_packages');
    }

    public function down()
    {
        $this->forge->dropTable('pricing_packages');
    }
}
