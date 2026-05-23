<?php

namespace App\Models;

use CodeIgniter\Model;

class TenantModel extends Model
{
    protected $table = 'tenants';
    protected $primaryKey = 'id';
    protected $allowedFields = ['owner_name', 'email', 'password', 'status'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $dateFormat = 'datetime';
    
    /**
     * Hash password sebelum menyimpan ke database
     */
    protected function beforeInsert(array $data)
    {
        $data = parent::beforeInsert($data);
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT, ['cost' => 12]);
        }
        return $data;
    }
    
    /**
     * Hash password saat update jika ada perubahan password
     */
    protected function beforeUpdate(array $data)
    {
        $data = parent::beforeUpdate($data);
        if (isset($data['data']['password']) && !empty($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT, ['cost' => 12]);
        }
        return $data;
    }
    
    /**
     * Verifikasi password tenant
     */
    public function verifyPassword(string $email, string $password): bool
    {
        $tenant = $this->where('email', $email)->first();
        if (!$tenant) {
            return false;
        }
        return password_verify($password, $tenant['password']);
    }
}
