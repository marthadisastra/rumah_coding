<?php

namespace App\Models;

use CodeIgniter\Model;

class SiteContentModel extends Model
{
    protected $table      = 'site_content';
    protected $primaryKey = 'id';
    protected $allowedFields = ['page_key', 'lang', 'title', 'body', 'effective_date', 'updated_at'];
    protected $useTimestamps = false;

    public function getPage(string $pageKey, string $lang = 'id')
    {
        return $this->where('page_key', $pageKey)
                    ->where('lang', $lang)
                    ->first();
    }
}
