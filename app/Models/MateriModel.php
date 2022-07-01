<?php namespace App\Models;

use CodeIgniter\Model;

class MateriModel extends Model
{
    protected $table = 'materi';
    protected $allowedFields = ['judul_materi','berkas'];
}