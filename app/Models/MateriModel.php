<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

class MateriModel extends Model
{
    protected $table = 'materi';
    protected $allowedFields = ['id_pertemuan','judul','dokumen'];

    
}