<?php

namespace App\Models;

use CodeIgniter\Model;

class PendaftarModel extends Model
{
    protected $table            = 'pendaftar'; // Nama tabel Anda
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    // PASTIKAN SEMUA KOLOM TERDAFTAR DI SINI! TERUTAMA 'alasan_penolakan'
    protected $allowedFields    = [
        'user_id',
        'nama_lengkap',
        'nama_panggilan',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'kewarganegaraan',
        'anak_ke',
        'jumlah_kakak',
        'jumlah_adik',
        'jenis_kelamin',
        'alamat',
        'tinggal_bersama',
        'asal_sekolah',
        'status_masuk',
        'diterima_kelas',
        'tanggal_diterima',
        'nama_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'alamat_ortu',
        'no_hp_ortu',
        'nama_wali',
        'alamat_wali',
        'nik',
        'no_kk',
        'no_hp',
        'foto_path',
        'kk_path',
        'skl_path',
        'ktp_ayah_path',
        'ktp_ibu_path',
        'akta_path',
        'skkb_path',
        'status', // Kolom status
        'alasan_penolakan' // <-- PASTIKAN INI ADA DAN TIDAK ADA TYPO!
    ];


    // Dates
    protected $useTimestamps = true; // Otomatis isi created_at & updated_at
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // Fungsi custom
    public function getPendaftarByUserId($userId)
    {
        return $this->where('user_id', $userId)->first();
    }
}

