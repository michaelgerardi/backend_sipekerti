<?php

namespace App\Models;


use CodeIgniter\Model;

class PertemuanModel extends Model
{
    
    protected $table = 'pertemuan';
    protected $useSoftDeletes = true;
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
<<<<<<< HEAD
    protected $allowedFields = ['id_kelas','id_pengajar','nama_pertemuan','tanggal_pertemuan','deskripsi_pertemuan','tempat','sub_cp','materi',
                                'indikator','metode_penilaian','metode_pembelajaran','pustaka','bobot','link','upload_image'];
=======
    protected $allowedFields = ['nama_pertemuan','tanggal_pertemuan','deskripsi_pertemuan','tempat','sub_cp','materi','indikator','metode_penilaian',
                                'metode_pembelajaran','pustaka','bobot','upload_image'];
>>>>>>> 87df145796cd6864b5e6c5f0a6900f71b5dc3066

    public function nama_pengajar($id = null){
        $builder = $this->db->table('pertemuan');
        $builder->select('nama,nama_kelas,nama_pertemuan,tanggal_pertemuan,deskripsi_pertemuan,tempat,sub_cp,materi,indikator,metode_penilaian,
                        metode_pembelajaran,pustaka,bobot,link,upload_image');
        $builder->join('users','pertemuan.id_pengajar =  users.id'); 
        $builder->join('kelas','pertemuan.id_kelas = kelas.id');
        $builder->getWhere(['id_kelas'=>$id]);
        $data = $builder->get();
        return $data;
    }

    public function getNama(){
        $builder = $this->db->table('pertemuan');
        $builder->select('pertemuan.id, id_kelas, id_pengajar, nama,nama_pertemuan,tanggal_pertemuan,deskripsi_pertemuan,tempat,sub_cp,materi,indikator,metode_penilaian,
        metode_pembelajaran,pustaka,bobot,link,upload_image');
        $builder->join('users','pertemuan.id_pengajar = users.id');
        $builder->Where('pertemuan.deleted_at IS NULL',NULL,false);
        $data = $builder->get();
        return $data;
    }
   
    public function getidpengajar($id = null){
        $builder = $this->db->table('pertemuan');
        $builder->select('nama,nama_pertemuan,tanggal_pertemuan,deskripsi_pertemuan,tempat,sub_cp,materi,indikator,metode_penilaian,
        metode_pembelajaran,pustaka,bobot,link,upload_image');
        $builder->join('users','pertemuan.id_pengajar = users.id');
        $builder->getWhere(['id_pengajar'=>$id]);
        $data = $builder->get();
        return $data;
    }

    public function getbyidkelas($id = null){
        $builder = $this->db->table('pertemuan');
        $builder->select('nama,nama_pertemuan,tanggal_pertemuan,deskripsi_pertemuan,tempat,sub_cp,materi,indikator,metode_penilaian,
        metode_pembelajaran,pustaka,bobot,link,upload_image');
        $builder->join('users','pertemuan.id_pengajar = users.id');
        $builder->getWhere(['id_kelas'=>$id] );
        $data = $builder->get();
        return $data;
    }
}
