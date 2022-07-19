<?php

namespace App\Models;


use CodeIgniter\Model;

class PertemuanModel extends Model
{
    
    protected $table = 'pertemuan';
    protected $useSoftDeletes = true;
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $allowedFields = ['nama_pertemuan','tanggal_pertemuan','deskripsi_pertemuan','tempat','sub_cp','materi','indikator','metode_penilaian',
                                'metode_pembelajaran','pustaka','bobot','upload_image'];


    
}
