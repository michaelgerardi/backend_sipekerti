<?php namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table = 'dosen';
    protected $useSoftDeletes = true;
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $allowedFields = ['nama_dosen','jenis_kelamin','tanggal_lahir','alamat','telepon','nik','nidn','tanda_tangan',
                                'gambar_profil','google_id'];
}