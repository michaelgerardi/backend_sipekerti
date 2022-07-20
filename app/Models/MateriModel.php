<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

class MateriModel extends Model
{
    protected $table = 'materi';
    protected $allowedFields = ['judul_materi','berkas'];
    public function __construct()
	{
		$this->db = \Config\Database::connect();
	}

    public function joindata(){
        $builder = $this->db->table('materi');
        $builder->select('nama_pertemuan,judul,dokumen');
        $builder->join('pertemuan','materi.id_pertemuan = pertemuan.id');
        $data = $builder->get();
        return $data;
    }
}