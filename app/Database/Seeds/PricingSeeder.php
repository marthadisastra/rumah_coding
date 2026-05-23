<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PricingSeeder extends Seeder
{
    public function run()
    {
        $packages = [
            [
                'name'           => 'Free',
                'slug'           => 'free',
                'price'          => 0,
                'max_instances'  => 1,
                'max_messages'   => 500,
                'max_portfolios' => 2,
                'features'       => json_encode([
                    '1 WA Instance',
                    '500 Pesan / bulan',
                    'Basic Messaging (Text/Image)',
                    '2 Item Software Portfolio',
                    'Webhook Event Standar',
                ]),
                'is_recommended' => 0,
                'is_dark_card'   => 0,
                'sort_order'     => 1,
                'is_active'      => 1,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'Personal',
                'slug'           => 'personal',
                'price'          => 49000,
                'max_instances'  => 1,
                'max_messages'   => 10000,
                'max_portfolios' => 20,
                'features'       => json_encode([
                    '1 WA Instance',
                    '10.000 Pesan / bulan',
                    'Advanced Msg (Video/Document)',
                    '20 Item Software Portfolio',
                    'Basic Auto-responder',
                ]),
                'is_recommended' => 0,
                'is_dark_card'   => 0,
                'sort_order'     => 2,
                'is_active'      => 1,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'Bisnis',
                'slug'           => 'bisnis',
                'price'          => 199000,
                'max_instances'  => 3,
                'max_messages'   => 100000,
                'max_portfolios' => -1,
                'features'       => json_encode([
                    '3 WA Instances',
                    '100.000 Pesan / bulan',
                    'Group Management & Polling',
                    'Typebot / Chatwoot Integrations',
                    'Unlimited Portfolios',
                ]),
                'is_recommended' => 1,
                'is_dark_card'   => 0,
                'sort_order'     => 3,
                'is_active'      => 1,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'Enterprise',
                'slug'           => 'enterprise',
                'price'          => 899000,
                'max_instances'  => 999,
                'max_messages'   => 1000000,
                'max_portfolios' => -1,
                'features'       => json_encode([
                    '10+ WA Instances',
                    '1 Juta+ Pesan / bulan',
                    'RabbitMQ Queue Integration',
                    'Multi-Device Blast Balancing',
                    'SLA 99.9% Uptime & Priority CS',
                ]),
                'is_recommended' => 0,
                'is_dark_card'   => 1,
                'sort_order'     => 4,
                'is_active'      => 1,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('pricing_packages')->insertBatch($packages);
    }
}
