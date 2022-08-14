<?php namespace App\Models;

use CodeIgniter\Model;

class KomentarModel extends Model
{
    protected $table = 'posting';
    protected $allowedFields = ['catatan', 'id_pertemuan', 'id_users'];
   
    public function getNama($id = null){
        $builder = $this->db->table('posting');
        $builder->select('posting.id, nama_pertemuan, catatan, nama, nik');
        $builder->join('pertemuan','posting.id_pertemuan = pertemuan.id');
        $builder->join('users','posting.id_users = users.id');
        $builder->Where(['id_pertemuan'=>$id]);
        $data = $builder->get();
        return $data;
    }

    public function getByUser($id = null){
        $builder = $this->db->table('posting');
        $builder->select('nama_pertemuan, catatan, nama');
        $builder->join('pertemuan','posting.id_pertemuan = pertemuan.id');
        $builder->join('users','posting.id_users = users.id');
        $builder->where('id_pertemuan ', $id);
        $builder->orWhere('id_users ', $id);
        $data = $builder->get();
        return $data;
    }
}