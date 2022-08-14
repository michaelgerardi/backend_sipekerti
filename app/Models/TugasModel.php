<?php namespace App\Models;

use CodeIgniter\Model;

class TugasModel extends Model
{
    protected $table = 'tugas';
    protected $allowedFields = ['id_pertemuan','judul','tanggal_mulai','tanggal_selesai','dokumen'];

}