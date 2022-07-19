<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

class NilaiModel extends Model
{
    protected $table = 'nilai';
    protected $allowedFields = ['nama_user','pertemuan1','pertemuan2','pertemuan3','nilai_akhir','status'];
    public $db;

    public function __construct()
	{
		$this->db = \Config\Database::connect();
	}

    public function countdata(){
        $builder= $this->db->table('nilai');
        $builder->select('status, COUNT(*) AS jumlah');
        $builder->groupBy('status');
        $data = $builder->get();
        return $data;
    }
}