<?php namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table = 'kelas';
    protected $allowedFields = ['nama_kelas','tanggal_mulai','tanggal_selesai','deskripsi','tahun'];

}