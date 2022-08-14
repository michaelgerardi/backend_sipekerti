<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\KelasModel;

class Kelas extends ResourceController
{
    protected $modelName = 'App\Models\KelasModel';
    use ResponseTrait;
    public $db;
   
    public function __construct()
	{
		$this->db = \Config\Database::connect();
	}
    // get all kelas
    public function index()
    {
        $model = new KelasModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }

    // create a kelas
    public function create()
    {
        $model = new KelasModel();
        $data = [
            'nama_kelas' => $this->request->getPost('nama_kelas'),
            'kode' => $this->request->getPost('kode_kelas'),
            'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tahun' => $this->request->getPost('tahun')
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

    public function deletePermanent($id = null){
        $data = $this->db->table('kelas')->where(['id'=>$id])->delete();
        return $this->respond($data,200);
      }

    public function history(){
        $model = new KelasModel();
        $data = $model->onlyDeleted()->findAll();
        return $this->respond($data, 200);
    }

    public function restore($id = null){
        $this->db = \Config\Database::connect();
        $data = $this->db->table('kelas')
        ->set('deleted_at',null,true)
        ->where('id',$id)->update();
        return $this->respond($data);

    }
    
      public function delete($id = null)
      {
          $model = new KelasModel();
          $data = $model->find($id);
          if($data){
              $model->delete($id);
              $response = [
                  'status'   => 200,
                  'error'    => null,
                  'messages' => [
                      'success' => 'Data Deleted'
                  ]
              ];
              
              return $this->respondDeleted($response);
          }else{
              return $this->failNotFound('No Data Found with id '.$id);
          }
          
      }

        // update Kelas
        public function update($id = null)
        {
            $model = new KelasModel();
            $json = $this->request->getJSON();
            if($json){
                $data = [
                    'nama_kelas' => $json->nama_kelas,
                    'kode_kelas' => $json->kode_kelas,
                    'tanggal_mulai' => $json->tanggal_mulai,
                    'tanggal_selesai' =>$json->tanggal_selesai,
                    'deskripsi'=>$json->deskripsi,
                    'tahun'=>$json->tahun
                ];
            }else{
                $input = $this->request->getRawInput();
                $data = [
<<<<<<< HEAD
                    'nama_kelas' => $input['nama_kelas'],
                    'kode_kelas' => $input['kode_kelas'],
                    'tanggal_mulai' => $input['tanggal_mulai'],
=======
                    'nama_kelas' => $input['nama_kelas'],                     'tanggal_mulai' => $input['tanggal_mulai'],
>>>>>>> 87df145796cd6864b5e6c5f0a6900f71b5dc3066
                    'tanggal_selesai'=>$input['tanggal_selesai'],
                    'deskripsi'=>$input['deskripsi'],
                    'tahun'=>$input['tahun']
                ];
            }
            // Insert to Database
            $model->update($id, $data);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Updated'
                ]
            ];
            return $this->respond($response);
        }

        // get id kelas
    public function show($id = null)
    {
        $model = new KelasModel();
        $data = $model->getWhere(['id' => $id])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }
<<<<<<< HEAD
    public function ses()
    {
        return $this->session->set_data;
    }
=======

    public function history(){
        $model = new KelasModel();
        $data = $model->onlyDeleted()->findAll();
        return $this->respond($data, 200);
    }

    public function restore($id = null){
        $this->db = \Config\Database::connect();
        $data = $this->db->table('kelas')
        ->set('deleted_at',null,true)
        ->where('id',$id)->update();
        return $this->respond($data);

    }

>>>>>>> 87df145796cd6864b5e6c5f0a6900f71b5dc3066
    
}