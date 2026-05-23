<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('admin_users')->insert([
            'email' => 'admin@rumahcoding.id',
            'password_hash' => password_hash('Admin123!', PASSWORD_DEFAULT),
            'name' => 'Administrator',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
