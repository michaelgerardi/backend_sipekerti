<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\PertemuanModel;
use CodeIgniter\Database\BaseBuilder;
 
class Pertemuan extends ResourceController
{
    protected $modelName = 'App\Models\PertemuanModel';
    use ResponseTrait;
    public $db;
   
    public function __construct()
	{
		$this->db = \Config\Database::connect();
	}


    // get all pertemuan
    public function index()
    {
        $model = new PertemuanModel();
        $data = $model->findall();
        return $this->respond($data, 200);
    }

      // delete kelas
      public function delete($id = null)
      {
          $model = new PertemuanModel();
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

      public function create(){
	    helper(['form']);

	 	$rules = [
	 		'nama_pertemuan' => 'required',
			'tanggal_pertemuan' => 'required',
            'deskripsi_pertemuan'=>'required',
            'tempat'=>'required',
            'sub_cp'=>'required',
            'materi'=>'required',
            'indikator'=>'required',
            'metode_penilaian'=>'required',
            'metode_pembelajaran'=>'required',
            'pustaka'=>'required',
            'bobot'=>'required',
	 		'upload_image' => 'uploaded[upload_image]|max_size[upload_image, 2000]|is_image[upload_image]'
	 	];

	 	if(!$this->validate($rules)){
	 		return $this->fail($this->validator->getErrors());
	 	}else{

	 		//Get the file
	 		$file = $this->request->getFile('upload_image');
	 		if(! $file->isValid())
	 			return $this->fail($file->getErrorString());

	 		$file->move('./assets/uploads');

	 		$data = [
	 			'nama_pertemuan' => $this->request->getPost('nama_pertemuan'),
	 			'tanggal_pertemuan' => $this->request->getPost('tanggal_pertemuan'),
                'deskripsi_pertemuan' => $this->request->getPost('deskripsi_pertemuan'),
	 			'tempat' => $this->request->getPost('tempat'),
                'sub_cp' => $this->request->getPost('sub_cp'),
	 			'materi' => $this->request->getPost('materi'),
                'indikator' => $this->request->getPost('indikator'),
     			'metode_penilaian' => $this->request->getPost('metode_penilaian'),
                'metode_pembelajaran' => $this->request->getPost('metode_pembelajaran'),
                'pustaka' => $this->request->getPost('pustaka'),
	 			'bobot' => $this->request->getPost('bobot'),
	 			'upload_image' => $file->getName()
	 		];

	 		$id = $this->model->insert($data);
	 		$data['id'] = $id;
	 		return $this->respondCreated($data);
	 	}
	}

    // get id pertemuan
    public function show($id = null)
    {
         $model = new PertemuanModel();
        $data = $model->getWhere(['id' => $id])->getResult();
        if($data){
             return $this->respond($data);
         }else{
             return $this->failNotFound('No Data Found with id '.$id);
         }
   }

   public function update($id = null){
    helper(['form', 'array']);

    $rules = [
        'nama_pertemuan' => 'required',
		'tanggal_pertemuan' => 'required',
        'deskripsi_pertemuan'=>'required',
        'tempat'=>'required',
        'sub_cp'=>'required',
        'materi'=>'required',
        'indikator'=>'required',
        'metode_penilaian'=>'required',
        'metode_pembelajaran'=>'required',
        'pustaka'=>'required',
        'bobot'=>'required',
    ];

    $fileName = dot_array_search('upload_image.name', $_FILES);

    if($fileName != ''){
        $img = ['upload_image' => 'uploaded[upload_image]|max_size[upload_image, 1024]|is_image[upload_image]'];
        $rules = array_merge($rules, $img);
    }

    if(!$this->validate($rules)){
        return $this->fail($this->validator->getErrors());
    }else{
        //$input = $this->request->getRawInput();
        $data = [
            'nama_pertemuan' => $this->request->getPost('nama_pertemuan'),
	 		'tanggal_pertemuan' => $this->request->getPost('tanggal_pertemuan'),
            'deskripsi_pertemuan' => $this->request->getPost('deskripsi_pertemuan'),
	 		'tempat' => $this->request->getPost('tempat'),
            'sub_cp' => $this->request->getPost('sub_cp'),
	 		'materi' => $this->request->getPost('materi'),
            'indikator' => $this->request->getPost('indikator'),
     		'metode_penilaian' => $this->request->getPost('metode_penilaian'),
            'metode_pembelajaran' => $this->request->getPost('metode_pembelajaran'),
            'pustaka' => $this->request->getPost('pustaka'),
	 		'bobot' => $this->request->getPost('bobot'),
        ];

        if($fileName != ''){

            $file = $this->request->getFile('upload_image');
            if(! $file->isValid())
                return $this->fail($file->getErrorString());

            $file->move('./assets/uploads');
            $data['upload_image'] = $file->getName();
        }

        $this->model->save($data);
        return $this->respond($data);
        }
    }

    public function getnama($id = null){
        $builder = $this->db->table('pertemuan');
        $builder->select('nama_pertemuan');
        $data = $builder->getWhere(['id'=>$id])->getResult();
        return $this->respond($data, 200);
    }

}          