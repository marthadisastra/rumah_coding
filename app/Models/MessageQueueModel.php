<?php

namespace App\Models;

use CodeIgniter\Model;

class MessageQueueModel extends Model
{
    protected $table = 'message_queues';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tenant_id',
        'wa_instance_id',
        'receiver_number',
        'message_payload',
        'status',
        'scheduled_at',
        'error_reason',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $dateFormat = 'datetime';
}
