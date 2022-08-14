<?php namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table          = 'kelas';
    protected $useSoftDeletes = true;
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $allowedFields = ['nama_kelas','kode_kelas','tanggal_mulai','tanggal_selesai','deskripsi','tahun'];

}