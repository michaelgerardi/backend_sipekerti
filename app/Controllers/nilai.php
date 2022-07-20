<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\NilaiModel;
use CodeIgniter\Database\BaseBuilder;

class nilai extends ResourceController
{

    protected $modelName = 'App\Models\NilaiModel';
    use ResponseTrait;
    public $db;

    public function __construct()
	{
		$this->db = \Config\Database::connect();
	}

    public function indexnilai(){
        $model = new NilaiModel();
        $data = $model->findall();
        return $this->respond($data, 200);
    }

    public function createnilai(){
        $model = new KelasModel();
        $data = [
            'nama_user' => $this->request->getPost('nama_user'),
            'pertemuan1'=>$this->request->getPost('pertemuan1'),
            'pertemuan2'=>$this->request->getPost('perteman2'),
            'pertemuan3'=>$this->request->getPost('pertemuan3'),
            'nilai_akhir'=>$this->request->getPost('nilai_akhir'),
            'status'=>$this->request->getPost('status')
            
        ];
        $data = json_decode(file_get_contents("php://input"));
        //$data = $this->request->getPost();
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];

        return $this->respondCreated($data, 201);    
    }

    public function dashboard(){
        $model = new NilaiModel();
        $data = $model->countdata()->getResult();
        return $this->respond($data,200);
    }

    public function nilai_peserta(){
        $model = new NilaiModel();
        $data = $model->datanilai_peserta()->getResult();
        return $this->respond($data,200);
    }


}