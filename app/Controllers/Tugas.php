<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\TugasModel;
 
class tugas extends ResourceController
{
    protected $modelName = 'App\Models\TugasModel';
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
        $model = new TugasModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }

    // create a Tugas
    public function create(){
		helper(['form']);

		$rules = [
			'judul' => 'required',
            'id_pertemuan' => 'required',
            'tanggal_mulai'=>'required|Date',
            'tanggal_selesai'=>'required|Date',
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
				'judul' => $this->request->getPost('judul'),
                'id_pertemuan' => $this->request->getPost('id_pertemuan'),
                'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
                'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
                'dokumen' => $file->getName()
			];

			$id = $this->model->insert($data);
			$data['id'] = $id;
			return $this->respondCreated($data);
		}
	}

      // get id tugas
     public function show($id = null)
    {
        $model = new TugasModel();
        $data = $model->getWhere(['id' => $id])->getResult();
        if($data){
             return $this->respond($data);
         }else{
             return $this->failNotFound('No Data Found with id '.$id);
         }
   }

       // delete Tugas
       public function delete($id = null)
       {
          $data = $this->db->table('tugas')->where(['id'=>$id])->delete();
          return $this->respond($data,200);      
      }

    public function update($id = null)
        {
            $model = new TugasModel();
            $json = $this->request->getJSON();
            if($json){
                $data = [
                    'judul' => $json->nama_kelas,
                    'tanggal_mulai' => $json->tanggal_mulai,
                    'tanggal_selesai' =>$json->tanggal_selesai,
                    'dokumen'=>$json->dokumen,
                    'tugas'=>$json->tugas
                ];
            }else{
                $input = $this->request->getRawInput();
                $data = [
                    'judul' => $input['judul'],
                    'tanggal_mulai' => $input['tanggal_mulai'],
                    'tanggal_selesai'=>$input['tanggal_selesai'],
                    'dokumen'=>$input['dokumen'],
                    'tugas'=>$input['tugas']
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

}