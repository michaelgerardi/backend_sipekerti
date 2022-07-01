<?php namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table = 'dosen';
    protected $allowedFields = ['nama_dosen','jenis_kelamin','tanggal_lahir','alamat','telepon','nik','nidn','tanda_tangan',
                                'gambar_profil','google_id'];
}