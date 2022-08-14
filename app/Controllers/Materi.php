<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\MateriModel;

class materi extends ResourceController
{
    protected $modelName = 'App\Models\MateriModel';
	protected $format = 'json';
    use ResponseTrait;
    public $db;

    public function __construct()
	{
		$this->db = \Config\Database::connect();
	}

    // view materi
    public function index()
    {
        $model = new MateriModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }
    
    //public function joindata(){
    //    $model = new MateriModel();
    //    $data = $model->joindata()->getResult();
    //    return $this->respond($data,200);
    //}
    
    public function getnama_pertemuan($id = null){
		$model = new MateriModel();
        $data = $model->nama_pertemuan($id)->getResult();
        return $this->respond($data,200);
	}
    
	public function create(){
		//helper(['form']);

		$rules = [
            'id_pertemuan' => 'required',
			'judul' => 'required',
			'dokumen' =>  'uploaded[dokumen]',
            'mime_in[dokumen,application/pdf,application/zip,application/msword,application/x-tar]',
            'max_size[dokumen,5000]',
		];

		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else
        {

			$file = $this->request->getFile('dokumen');
			if(! $file->isValid())
				return $this->fail($file->getErrorString());
                
			$file->move('./assets/uploads');
            $model = new MateriModel();
			$data = [
                'id_pertemuan' => $this->request->getPost('id_pertemuan'),
				'judul' => $this->request->getPost('judul'),
				'dokumen' => $file->getName()
			];

			//$id = $this->model->insert($data);
			//$data['id'] = $id;
            $model->insert($data);
			return $this->respondCreated($data);
		}
	}

     // get id materi
     public function show($id = null)
    {
         $model = new MateriModel();
        $data = $model->getWhere(['id' => $id])->getResult();
        if($data){
             return $this->respond($data);
         }else{
             return $this->failNotFound('No Data Found with id '.$id);
         }
   }

   public function joindata(){
    //$builder = $this->db->table('materi');
    //$builder->select('nama_pertemuan,judul,dokumen');
    //$builder->join('pertemuan','materi.id_pertemuan = pertemuan.id');
    //$data = $builder->get();
    //return $data;
}

public function nama_pertemuan($id = null){
    //$builder = $this->db->table('materi');
    //$builder->select('nama_pertemuan, judul, dokumen');
    //$builder->join('pertemuan','materi.id_pertemuan = pertemuan.id');
    //$builder->Where(['id_pertemuan'=>$id]);
    //$data = $builder->get();
    //return $data;
}

    public function getMateri($id = null)
    {
        $model = new MateriModel();
        $data = $model->getWhere(['id_pertemuan' => $id])->getResult();
        return $this->respond($data, 200);
    }

   public function deletePermanent($id = null){
    $data = $this->db->table('materi')->where(['id'=>$id])->delete();
    return $this->respond($data,200);
  }

    public function update($id = null){
		helper(['form', 'array']);

		$rules = [
			'judul_materi' => 'required'
		];


		$fileName = dot_array_search('berkas.name', $_FILES);

		if($fileName != ''){
			$upload = ['uploaded[berkas]',
            'mime_in[berkas,application/pdf,application/zip,application/msword,application/x-tar]',
            'max_size[berkas,5000]'];
			$rules = array_merge($rules, $upload);
		}



		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{
			//$input = $this->request->getRawInput();



			$data = [
				'post_id' => $id,
				'post_title' => $this->request->getVar('title'),
				'post_description' => $this->request->getVar('description'),
			];

			if($fileName != ''){

				$file = $this->request->getFile('featured_image');
				if(! $file->isValid())
					return $this->fail($file->getErrorString());

				$file->move('./assets/uploads');
				$data['post_featured_image'] = $file->getName();
			}

			$this->model->save($data);
			return $this->respond($data);
		}
	}

	public function joindata(){
        $model = new MateriModel();
        $data = $model->joindata()->getResult();
        return $this->respond($data,200);
    }
}




