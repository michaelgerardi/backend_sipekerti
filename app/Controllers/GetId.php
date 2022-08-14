<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Database\BaseBuilder;
use App\Models\PertemuanModel;
use App\Models\TugasModel;
use App\Models\MateriModel;
use App\Models\KomentarModel;

class GetId extends ResourceController
{
    public function __construct()
	{
		$this->db = \Config\Database::connect();
	}

    protected $modelName = 'App\Models\PertemuanModel';
    protected $modelmateri = 'App\Models\MateriModel';
    protected $modeltugas = 'App\Models\TugasModel';
    protected $modelposting = 'App\Models\KomentarModel';
    use ResponseTrait;
   
    // get all pertemuan
    public function index($id = null)
    {
        $model = new PertemuanModel();
        $data = $model->nama_pengajar($id)->getResult();
        return $this->respond($data, 200);
    }

    public function getpertemuan($id = null)
    {
        $model = new PertemuanModel();
        $data = $model->getWhere(['id' => $id])->getResult();
        return $this->respond($data, 200);
    }

    public function getMateri($id = null)
    {
        $model = new MateriModel();
        $data = $model->getWhere(['id_pertemuan' => $id])->getResult();
        return $this->respond($data, 200);
    }

    public function getTugas($id = null)
    {
        $model = new TugasModel();
        $data = $model->getWhere(['id_pertemuan' => $id])->getResult();
        return $this->respond($data, 200);
    }

    public function getPosting($id = null)
    {
        $model = new KomentarModel();
        $data = $model->getWhere(['id_pertemuan' => $id])->getResult();
        return $this->respond($data, 200);
    }

    //public function getnama($id = null){
    //    $builder = $this->db->table('pertemuan');
    //    $builder->select('nama_pertemuan');
    //    $data = $builder->getWhere(['id'=>$id])->getResult();
    //    return $this->respond($data, 200);
    //}
}