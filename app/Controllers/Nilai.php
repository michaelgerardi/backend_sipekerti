<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\NilaiModel;
use CodeIgniter\HTTP\Response;

class nilai extends ResourceController
{
    protected $modelName = 'App\Models\NilaiModel';
	protected $format = 'json';
    use ResponseTrait;
    public $db;

    public function __construct()
	{
		$this->db = \Config\Database::connect();
	}

    public function grafik_lulus()
    {
        $model = new NilaiModel();
        $data = $model->grafiklulus()->getResult();
        return $this->respond($data,200);  
    }

    public function grafik_tidaklulus()
    {
        $model = new NilaiModel();
        $data = $model->grafiktidaklulus()->getResult();
        return $this->respond($data,200);  
    }
    
    public function index()
    {
        $model = new NilaiModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }

    public function create(){
        //helper(['form']);
        $model = new NilaiModel();
	 		$data = [
                'id_tugas' => $this->request->getPost('id_tugas'),
	 			//'id_pengajar' => $this->request->getPost('id_pengajar'),
	 			'id_peserta' => $this->request->getPost('id_peserta'),
	 			'nilai' => $this->request->getPost('nilai'),
                'status' => $this->request->getPost('status')
	 		];
            $data = json_decode(file_get_contents("php://input"));
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

    //public function update($id = null){
    //    helper(['form']);

    //    $rules = [
    //        'id_tugas' => 'required',
    //        'id_pengajar' => 'required',
	// 		'id_peserta' => 'required',
	//		'nilai' => 'required',
    //        'status'=>'required'
	// 	];

    //     if(!$this->validate($rules)){
    //        return $this->fail($this->validator->getErrors());
    //    }else{
    //        //$model = new NilaiModel();
	// 		$data = [
    //            'id_tugas' => $this->request->getPost('id_tugas'),
	// 			'id_pengajar' => $this->request->getPost('id_pengajar'),
	// 			'id_peserta' => $this->request->getPost('id_peserta'),
	// 			'nilai' => $this->request->getPost('nilai'),
    //            'status' => $this->request->getPost('status')
	// 		];
    //        $id = $this->model->save($data);
    //        //$data['id'] = $id;
	// 		return $this->respondCreated($data);
    //    }
    //}

    public function update_nilai($id = null)
    {
        $model = new NilaiModel();
        $json = $this->request->getJSON();
        if($json){
            $data = [
                'id_tugas' => $json->id_tugas,
                //'id_pengajar' => $json->id_pengajar,
                'id_peserta' => $json->id_peserta,
                'nilai' => $json->nilai,
                'status' => $json->status
            ];
        }else{
            $input = $this->request->getRawInput();
            $data = [
                'id_tugas' => $input['id_tugas'],
                //'id_pengajar' => $input['id_pengajar'],
                'id_peserta' => $input['id_peserta'],
                'nilai' => $input['nilai'],
                'status' => $input['status']
            ];
        }
        // Insert to Database
        $model->update($id,$data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }

     public function show($id = null)
    {
        $model = new NilaiModel();
        $data = $model->getWhere(['id_tugas' => $id])->getResult();
        return $this->respond($data, 200);
    }

    public function getnilai($id = null){
        $model = new NilaiModel();
        $data = $model->getnilai($id)->getResult();
        return $this->respond($data,200);
    }

    public function nilaiById(){
        $model = new NilaiModel();
        $data = $model->nilaiById()->getResult();
        return $this->respond($data,200);
    }

    public function datalulus(){
        $model = new NilaiModel();
        $data = $model->datalulus()->getResult();
        return $this->respond($data,200);
    }

    public function datatidaklulus(){
        $model = new NilaiModel();
        $data = $model->datatidaklulus()->getResult();
        return $this->respond($data,200);
    }

    public function delete($id = null)
    {
       $data = $this->db->table('nilai')->where(['id'=>$id])->delete();
       return $this->respond($data,200);      
   }
}