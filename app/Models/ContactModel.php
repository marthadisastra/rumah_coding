<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
    protected $table = 'contacts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tenant_id', 'contact_name', 'phone_number', 'tags', 'created_at'];
    protected $useTimestamps = false;
}
