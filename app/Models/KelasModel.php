<?php namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
<<<<<<< HEAD
    protected $table          = 'kelas';
=======
    protected $table                = 'kelas';
>>>>>>> 87df145796cd6864b5e6c5f0a6900f71b5dc3066
    protected $useSoftDeletes = true;
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
<<<<<<< HEAD
    protected $allowedFields = ['nama_kelas','kode_kelas','tanggal_mulai','tanggal_selesai','deskripsi','tahun'];
=======
    protected $allowedFields        = ['nama_kelas','tanggal_mulai','tanggal_selesai','deskripsi','tahun'];
>>>>>>> 87df145796cd6864b5e6c5f0a6900f71b5dc3066

}