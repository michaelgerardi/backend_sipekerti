<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\MateriModel;

class materi extends ResourceController
{
    protected $modelName = 'App\Models\MateriModel';
	protected $format = 'json';
    use ResponseTrait;

    // view materi
    public function index()
    {
        $model = new MateriModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }
    
	public function create(){
		helper(['form']);

		$rules = [
			'judul_materi' => 'required',
			'berkas' =>  'uploaded[berkas]',
            'mime_in[berkas,application/pdf,application/zip,application/msword,application/x-tar]',
            'max_size[berkas,5000]',
		];

		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else
        {

			$file = $this->request->getFile('berkas');
			if(! $file->isValid())
				return $this->fail($file->getErrorString());
			$file->move('./assets/uploads');
			$data = [
				'judul_materi' => $this->request->getPost('judul_materi'),
				'berkas' => $file->getName()
			];

			$id = $this->model->insert($data);
			$data['id'] = $id;
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

   //delete materi
   public function delete($id = null)
   {
       $model = new MateriModel();
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

	public function downloadmateri($id ){
		$model = new MateriModel();
		$data = $model->find($id);
		//return $this-> ->download('./assets/uploads'. $data->model,null);
	} 

}




