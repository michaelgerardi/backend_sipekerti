<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\TugasPesertaModel;
 
class tugaspeserta extends ResourceController
{
    protected $modelName = 'App\Models\TugasPesertaModel';
	protected $format = 'json';
    use ResponseTrait;
    public $db;

    public function __construct()
	{
		$this->db = \Config\Database::connect();
	}
    // get all Tugas
    public function index()
    {
        $model = new TugasPesertaModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }

    public function getData($id = null){
        $model = new TugasPesertaModel();
        $data = $model->getNama($id)->getResult();
        return $this->respond($data, 200);
    }

    public function getTugas($id = null)
    {
        $model = new TugasPesertaModel();
        $data = $model->getWhere(['id_pertemuan' => $id])->getResult();
        return $this->respond($data, 200);
    }

    // create a Tugas
    public function create(){
		helper(['form']);

		$rules = [
			'id_tugas' => 'required',
            'id_users' => 'required',
            'dokumen'=>'uploaded[dokumen]',
            'mime_in[dokumen,application/pdf,application/zip,application/msword,application/x-tar]',
            'max_size[dokumen,5000]'
		];

		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{

			//Get the file
            $file = $this->request->getFile('dokumen');
            if(! $file->isValid())
				return $this->fail($file->getErrorString());
            $file->move('./assets/uploads');

			$data = [
				'id_tugas' => $this->request->getPost('id_tugas'),
                'id_users' => $this->request->getPost('id_users'),
                'dokumen' => $file->getName()
			];

			$id = $this->model->insert($data);
			$data['id'] = $id;
			return $this->respondCreated($data);
		}
	}
      // get id tugas
//     public function show($id = null)
//    {
//         $model = new TugasModel();
//        $data = $model->getWhere(['id' => $id])->getResult();
//        if($data){
//             return $this->respond($data);
//         }else{
//             return $this->failNotFound('No Data Found with id '.$id);
//         }
//   }

//       // delete Tugas
       public function delete($id = null)
     {
        $data = $this->db->table('tugas_peserta')->where(['id'=>$id])->delete();
        return $this->respond($data,200);      
    }

    public function history_tugaspeserta(){
        $model = new tugaspesertaModel();
        $data = $model->onlyDeleted()->findAll();
        return $this->respond($data, 200);
    }

    public function restore_tugaspeserta($id = null){
        $this->db = \Config\Database::connect();
        $data = $this->db->table('tugas_peserta')
        ->set('deleted_at',null,true)
        ->where('id',$id)->update();
        return $this->respond($data);
    }

    public function viewAllDeletedNull(){
        $model = new TugasPesertaModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }

//    public function update($id = null)
//        {
//            $model = new TugasModel();
//            $json = $this->request->getJSON();
//            if($json){
//                $data = [
//                    'judul' => $json->nama_kelas,
//                    'tanggal_mulai' => $json->tanggal_mulai,
//                    'tanggal_selesai' =>$json->tanggal_selesai,
//                    'dokumen'=>$json->dokumen,
//                    'tugas'=>$json->tugas
//                ];
//            }else{
//                $input = $this->request->getRawInput();
//                $data = [
//                    'judul' => $input['judul'],
//                    'tanggal_mulai' => $input['tanggal_mulai'],
//                    'tanggal_selesai'=>$input['tanggal_selesai'],
//                    'dokumen'=>$input['dokumen'],
//                    'tugas'=>$input['tugas']
//                ];
//            }
//            // Insert to Database
//            $model->update($id, $data);
//            $response = [
//                'status'   => 200,
//                'error'    => null,
//                'messages' => [
//                    'success' => 'Data Updated'
//                ]
//            ];
//            return $this->respond($response);
//        }

}