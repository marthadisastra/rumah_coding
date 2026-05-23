<?php

namespace App\Models;

use CodeIgniter\Model;

class PricingPackageModel extends Model
{
    protected $table      = 'pricing_packages';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'slug', 'price', 'max_instances', 'max_messages',
        'max_portfolios', 'features', 'is_recommended', 'is_dark_card',
        'sort_order', 'is_active',
    ];
    protected $useTimestamps = true;

    public function getActive()
    {
        return $this->where('is_active', 1)
                    ->orderBy('sort_order', 'ASC')
                    ->findAll();
    }
}
