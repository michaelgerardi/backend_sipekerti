<?php namespace App\Models;

use CodeIgniter\Model;
<<<<<<< HEAD
=======
use CodeIgniter\Database\BaseBuilder;
>>>>>>> 87df145796cd6864b5e6c5f0a6900f71b5dc3066

class NilaiModel extends Model
{
    protected $table = 'nilai';
<<<<<<< HEAD
    protected $allowedFields = ['id_tugas','id_peserta','nilai','status'];

    public function getnilai($id = null){
        $builder = $this->db->table('nilai');
        $builder->select('nilai.id,nama,judul,nilai,status');
        $builder->join('users','nilai.id_peserta =  users.id');
        $builder->join('tugas','nilai.id_tugas = tugas.id');
        $builder->Where(['id_tugas' => $id]);
        $data = $builder->get();
        return $data;
    }
    

    //public function nilaiById(){
    //    $builder = $this->db->table('nilai');
    //    $builder->select('*');
    //    $builder->groupBy('id_tugas');
    //    $data = $builder->get();
    //    return $data;
    //}

    //public function grafiklulus()
    //{
    //    $builder= $this->db->table('nilai');
    //    $builder->select('id_tugas,status');
    //    $builder->Where('status','lulus');
    //    $builder->groupBy('id_tugas');
    //    $data = $builder->get();
    //    return $data;
    //}

    //public function grafiktidaklulus()
    //{
    //    $builder= $this->db->table('nilai');
    //    $builder->select('judul, COUNT(*) AS total');
    //    $builder->join('tugas','nilai.id_tugas =  tugas.id');
    //    $builder->Where('status','tidak lulus');
    //    $builder->groupBy('id_tugas');
    //    $data = $builder->get();
    //    return $data;
    //}

    public function datalulus()
    {
        $builder= $this->db->table('nilai');
        $builder->select('nama,judul,nilai,status');
        $builder->join('users','nilai.id_peserta = users.id');
        $builder->join('tugas','nilai.id_tugas = tugas.id');
        $builder->where('status','LULUS');
=======
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
>>>>>>> 87df145796cd6864b5e6c5f0a6900f71b5dc3066
        $data = $builder->get();
        return $data;
    }

<<<<<<< HEAD
    public function datatidaklulus()
    {
        $builder= $this->db->table('nilai');
        $builder->select('nama,judul,nilai,status');
        $builder->join('users','nilai.id_peserta = users.id');
        $builder->join('tugas','nilai.id_tugas = tugas.id');
        $builder->where('status','TIDAK LULUS');
=======
    public function datanilai_peserta(){
        $builder = $this->db->table('nilai');
        $builder->select('nama,nilai,status');
        $builder->join('users','nilai.id_peserta = users.id');
>>>>>>> 87df145796cd6864b5e6c5f0a6900f71b5dc3066
        $data = $builder->get();
        return $data;
    }
}