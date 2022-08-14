<?php namespace App\Models;

use CodeIgniter\Model;

class TugasPesertaModel extends Model
{
    protected $table = 'tugas_peserta';
    protected $allowedFields = ['id_tugas','id_users','dokumen'];

    public function getNama($id = null){
        $builder = $this->db->table('tugas_peserta');
        $builder->select('tugas_peserta.id,nama, dokumen');
        $builder->join('users','tugas_peserta.id_users = users.id');
        $builder->Where(['id_tugas'=>$id]);
        $data = $builder->get();
        return $data;
    }
}