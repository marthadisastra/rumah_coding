<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSiteContentTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'page_key'     => ['type' => 'VARCHAR', 'constraint' => 50],   // privacy_policy | terms_of_service | about_us
            'lang'         => ['type' => 'VARCHAR', 'constraint' => 5, 'default' => 'id'], // id | en
            'title'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'body'         => ['type' => 'LONGTEXT'],
            'effective_date' => ['type' => 'DATE', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['page_key', 'lang']);
        $this->forge->createTable('site_content');
    }

    public function down()
    {
        $this->forge->dropTable('site_content');
    }
}
