<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DosenModel;
use App\Models\UserModel;

class Dosen extends ResourceController
{
    protected $modelName = 'App\Models\UserModel';
	protected $format = 'json';
    use ResponseTrait;
    public $db;

    public function __construct()
	{
		$this->db = \Config\Database::connect();
	}
    // get all Dosen
    //public function index()
    //{
    //    $model = new DosenModel();
    //    $data = $model->findAll();
    //    return $this->respond($data, 200);
    //}

    public function select_peserta(){
        $model = new UserModel();
        $data = $model->where('level',3)->findAll();
      return $this->respond($data, 200);
    }

    public function select_pengajar(){
        $model = new UserModel();
        $data = $model->where('level',2)->findAll();
      return $this->respond($data, 200);
    }

    public function delete($id = null)
       {
          $data = $this->db->table('users')->where(['id'=>$id])->delete();
          return $this->respond($data,200);      
      }

    public function history(){
        $model = new UserModel();
        $data = $model->onlyDeleted()->findAll();
        return $this->respond($data, 200);
    }

    public function restore($id = null){
        $this->db = \Config\Database::connect();
        $data = $this->db->table('users')
        ->set('deleted_at',null,true)
        ->where('id',$id)->update();
        return $this->respond($data);

    }

    // create a Dosen
    //public function create()
    //{
    //    $model = new DosenModel();
    //    $data = [
    //        'nama_dosen' => $this->request->getPost('nama_dosen'),
    //        'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
    //        'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
    //        'alamat' => $this->request->getPost('alamat'),
    //        'telepon' => $this->request->getPost('telepon'),
    //        'nik' => $this->request->getPost('nik'),
    //        'nidn' => $this->request->getPost('nidn'),
    //        'tanda_tangan' => $this->request->getPost('tanda_tangan'),
    //        'gambar_profil' => $this->request->getPost('gambar_profil'),
    //        'google_id' => $this->request->getPost('google_id')
    //    ];
    //    $data = json_decode(file_get_contents("php://input"));
    //    //$data = $this->request->getPost();
    //    $model->insert($data);
    //    $response = [
    //        'status'   => 201,
    //        'error'    => null,
    //        'messages' => [
    //            'success' => 'Data Saved'
    //        ]
    //    ];

    //    return $this->respondCreated($data, 201);
    //}

    //// delete dosen
    //public function delete($id = null)
    //{
    //    $model = new DosenModel();
    //    $data = $model->find($id);
    //    if($data){
    //        $model->delete($id);
    //        $response = [
    //            'status'   => 200,
    //            'error'    => null,
    //            'messages' => [
    //                'success' => 'Data Deleted'
    //            ]
    //        ];
            
    //        return $this->respondDeleted($response);
    //    }else{
    //        return $this->failNotFound('No Data Found with id '.$id);
    //    }
        
    //}

    //// update dosen
    //public function update($id = null)
    //{
    //    $model = new DosenModel();
    //    $json = $this->request->getJSON();
    //    if($json){
    //        $data = [
    //            'nama_dosen' => $json->nama_dosen,
    //            'jenis_kelamin' => $json->jenis_kelamin,
    //            'tanggal_lahir' =>$json->tanggal_lahir,
    //            'alamat'=>$json->alamat,
    //            'telepon'=>$json->telepon,
    //            'nik'=>$json->nik,
    //            'nidn'=>$json->nidn,
    //            'tanda_tangan'=>$json->tanda_tangan,
    //            'gambar_profil'=>$json->gambar_profil,
    //            'google_id'=>$json->google_id
    //        ];
    //    }else{
    //        $input = $this->request->getRawInput();
    //        $data = [
    //            'nama_dosen' => $input['nama_dosen'],
    //            'jenis_kelamin' => $input['jenis_kelamin'],
    //            'tanggal_lahir'=>$input['tanggal_lahir'],
    //            'alamat'=>$input['alamat'],
    //            'telepon'=>$input['telepon'],
    //            'nik'=>$input['nik'],
    //            'nidn'=>$input['nidn'],
    //            'tanda_tangan'=>$input['tanda_tangan'],
    //            'gambar_profil'=>$input['gambar_profil'],
    //            'google_id'=>$input['google_id']
    //        ];
    //    }
        // Insert to Database
    //    $model->update($id, $data);
    //    $response = [
    //        'status'   => 200,
    //        'error'    => null,
    //        'messages' => [
    //            'success' => 'Data Updated'
    //        ]
    //    ];
    //    return $this->respond($response);
    //}

    public function history(){
        $model = new DosenModel();
        $data = $model->onlyDeleted()->findAll();
        return $this->respond($data, 200);
    }

    public function restore($id = null){
        $this->db = \Config\Database::connect();
        $data = $this->db->table('dosen')
        ->set('deleted_at',null,true)
        ->where('id',$id)->update();
        return $this->respond($data);

    }

}