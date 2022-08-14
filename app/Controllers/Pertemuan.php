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

    public function viewAllDeletedNull(){
        $model = new PertemuanModel();
        $data = $model->getNama()->getResult();
        return $this->respond($data, 200);
    }

    public function deletePermanent($id = null){
        $data = $this->db->table('pertemuan')->where(['id'=>$id])->delete();
        return $this->respond($data,200);
    }

    // get all pertemuan
    public function index()
    {
        $model = new PertemuanModel();
        $data = $model->nama_pengajar()->getResult();
        return $this->respond($data, 200);
    }

    public function getbyidkelas($id = null){
        $model = new PertemuanModel();
        $data = $model->getbyidkelas($id)->getResult();
        return $this->respond($data, 200);
    }
    //public function pertemuanPengajar($id = null){
    //    $model = new PertemuanModel();
    //    $data = $model->getWhere(['id'=>$id])->getResult();
    //    return $this->respond($data, 200);
    //}
    
      public function delete($id = null)
      {
          $model = new PertemuanModel();
          $data = $model->getNama($id);
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
        //$data = $this->db->table('pertemuan')->where(['id'=>$id])->delete();
        //return $this->respond($data,200);  
      }

      public function update_pertemuan($id = null)
      {
          $model = new PertemuanModel();
          $json = $this->request->getJSON();
          //return $this->respond($json);
          print_r($json);
          
          $data = [
            'id_kelas' => $this->request->getPost('id_kelas'),
             'id_pengajar' => $this->request->getPost('id_pengajar'),
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
            'link' => $this->request->getPost('link')
         ];
            $file = $this->request->getFile('upload_image');
            if(!empty($file)){
                if(! $file->isValid())
	 			return $this->fail($file->getErrorString());
                 $file->move('./assets/uploads');
                $data['upload_image']=$file->getName();
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
  
    public function history_pertemuan(){
        $model = new PertemuanModel();
        $data = $model->onlyDeleted()->findAll();
        return $this->respond($data, 200);
    }

    public function restore_pertemuan($id = null){
        $this->db = \Config\Database::connect();
        $data = $this->db->table('pertemuan')
        ->set('deleted_at',null,true)
        ->where('id',$id)->update();
        return $this->respond($data);

    }
    
      public function create(){
	   // helper(['form']);

	 	$rules = [
            'id_kelas' => 'required',
            'id_pengajar' => 'required',
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
            'link'=>'required',
	 		'upload_image' => 'uploaded[upload_image]|max_size[upload_image, 2000]|is_image[upload_image]'
	 	];
        //return $this->request->getFile('upload_image')->getName();
	 	if(!$this->validate($rules)){
	 		return $this->fail($this->validator->getErrors());
	 	}else{

	 		//Get the file
	 		$file = $this->request->getFile('upload_image');
	 		if(! $file->isValid())
	 			return $this->fail($file->getErrorString());

	 		$file->move('./assets/uploads');
            $model = new PertemuanModel();
	 		$data = [
                'id_kelas' => $this->request->getPost('id_kelas'),
	 			'id_pengajar' => $this->request->getPost('id_pengajar'),
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
                'link' => $this->request->getPost('link'),
	 			'upload_image' => $file->getName()
	 		];
            $model->insert($data);
	 		return $this->respondCreated($data);
	 	}
	}

    //public function meetingPengajar($id = null)
    //{
    //    $model = new PertemuanModel();
    //    $data = $model->getWhere(['id_pengajar' => $id])->getResult();
    //    return $this->respond($data, 200);
    //}

    // get id pertemuan
    public function show($id = null)
    {
        $model = new PertemuanModel();
        $data = $model->getWhere(['id_pengajar' => $id])->getResult();
        if($data){
             return $this->respond($data);
         }else{
             return $this->failNotFound('No Data Found with id '.$id);
         }
   }

   public function update($id = null){
    //helper(['form', 'array']);

    $rules = [
            'id_kelas' => 'required',
            'id_pengajar' => 'required',
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
            'link'=>'required',
	 		'upload_image' => 'uploaded[upload_image]|max_size[upload_image, 2000]|is_image[upload_image]'
    ];

    $fileName = dot_array_search('upload_image.name', $_FILES);

    //if($fileName ){
    //    $img = ['upload_image' => 'uploaded[upload_image]|max_size[upload_image, 1024]|is_image[upload_image]'];
    //    $rules = array_merge($rules, $img);
    //}

    if(!$this->validate($rules)){
        return $this->fail($this->validator->getErrors());
    }else{
        //$input = $this->request->getRawInput();
        $data = [
            'id_kelas' => $this->request->getPost('id_kelas'),
            'id_pengajar' => $this->request->getPost('id_pengajar'),
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
            'link' => $this->request->getPost('link')
        ];

        if (empty($fileName)) {

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

    public function pertemuanByPengajar($id = null)
    {
        $model = new PertemuanModel();
        $data = $model->getidpengajar($id)->getResult();
        return $this->respond($data, 200);
    }
}          