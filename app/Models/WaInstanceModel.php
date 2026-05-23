<?php

namespace App\Models;

use CodeIgniter\Model;

class WaInstanceModel extends Model
{
    protected $table = 'wa_instances';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tenant_id',
        'instance_name',
        'instance_token',
        'phone_number',
        'connection_status',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $dateFormat = 'datetime';
}
