<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\KomentarModel;

class Komentar extends ResourceController
{
    protected $modelName = 'App\Models\KomentarModel';
	protected $format = 'json';
    use ResponseTrait;
    public $db;

    public function __construct()
	{
		$this->db = \Config\Database::connect();
	}

    // get all Komentar
    public function index()
    {
        $model = new KomentarModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }

    // create a komentar
    public function create()
    {
        $model = new KomentarModel();
        $rules = [
            'catatan'=> $this->request->getPost('catatan'), 
            'id_pertemuan'=> $this->request->getPost('id_pertemuan'),
            'id_users'=> $this->request->getPost('id_users')
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

    public function getData($id = null){
        $model = new KomentarModel();
        $data = $model->getNama($id)->getResult();
        return $this->respond($data, 200);
    }

    public function getByUser($id = null){
        $model = new KomentarModel();
        $data = $model->getByUser($id)->getResult();
        return $this->respond($data, 200);
    }

    // delete komentar
    public function delete($id = null)
    {
       $data = $this->db->table('posting')->where(['id'=>$id])->delete();
       return $this->respond($data,200);      
   }

    //truncate data komentar
    public function deleteall(){
        $model = new KomentarModel();
        $data = $model->emptyTable();
        if($data){
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
            
            return $this->respondDeleted($response);
        }
    }

      // update Komentar
      public function update($id = null)
      {
          $model = new KomentarModel();
          $json = $this->request->getJSON();
          if($json){
              $data = [
                  'catatan' => $json->catatan,
                  'id_pengajar' => $json->id_pengajar,
                  'komentar' => $json->komentar,
                  'id_peserta' => $json->id_peserta,
                  'id_pertemuan' => $json->id_pertemuan
                  
              ];
          }else{
              $input = $this->request->getRawInput();
              $data = [
                    'catatan'=> $input['catatan'], 
                    'id_pengajar'=> $input['id_pengajar'], 
                    'komentar'=> $input['komentar'], 
                    'id_peserta' => $input['id_peserta'],
                    'id_pertemuan' => $input['id_pertemuan']
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

      public function getnama_pertemuan($id = null){
		$model = new KomentarModel();
        $data = $model->nama_pertemuan($id)->getResult();
        return $this->respond($data,200);
	}
}