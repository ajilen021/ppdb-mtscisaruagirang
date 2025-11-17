<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    /**
     * INI BAGIAN YANG DIPERBAIKI
     * Kita tambahkan 'verification_token' dan 'is_verified'
     */
    protected $allowedFields    = ['email', 'password', 'verification_token', 'is_verified'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // Tidak ada updated_at di tabel users

    // Validation
    protected $validationRules = [
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]',
    ];
    protected $validationMessages   = [
        'email' => [
            'is_unique' => 'Email ini sudah terdaftar.'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $beforeInsert = ['hashPassword'];
    // Kita juga perlu 'hashPassword' untuk 'beforeUpdate' jika Anda nanti membuat fitur ganti password
    // protected $beforeUpdate = ['hashPassword']; 

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}