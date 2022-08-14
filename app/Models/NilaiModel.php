<?php namespace App\Models;

use CodeIgniter\Model;

class NilaiModel extends Model
{
    protected $table = 'nilai';
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
        $data = $builder->get();
        return $data;
    }

    public function datatidaklulus()
    {
        $builder= $this->db->table('nilai');
        $builder->select('nama,judul,nilai,status');
        $builder->join('users','nilai.id_peserta = users.id');
        $builder->join('tugas','nilai.id_tugas = tugas.id');
        $builder->where('status','TIDAK LULUS');
        $data = $builder->get();
        return $data;
    }
}