<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('PricingSeeder');
        $this->call('SiteContentSeeder');
        $this->call('AdminUserSeeder');
    }
}
