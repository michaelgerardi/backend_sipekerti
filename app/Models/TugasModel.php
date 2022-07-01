<?php namespace App\Models;

use CodeIgniter\Model;

class TugasModel extends Model
{
    protected $table = 'tugas';
    protected $allowedFields = ['nama_tugas','tanggal_tugas','nilai','file'];

}