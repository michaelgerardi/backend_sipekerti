<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\TugasModel;
 
class tugas extends ResourceController
{
    protected $modelName = 'App\Models\TugasModel';
	protected $format = 'json';
    use ResponseTrait;
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
			'nama_tugas' => 'required',
            'tanggal_tugas'=>'required|Date',
            'nilai'=>'required',
			'file' =>  'uploaded[file]',
            'mime_in[file,application/pdf,application/zip,application/msword,application/x-tar]',
            'max_size[file,5000]',
		];

		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{

			//Get the file
			$file = $this->request->getFile('file');
			if(! $file->isValid())
				return $this->fail($file->getErrorString());

			$file->move('./assets/uploads');

			$data = [
				'nama_tugas' => $this->request->getPost('nama_tugas'),
                'tanggal_tugas' => $this->request->getPost('tanggal_tugas'),
                'nilai' => $this->request->getPost('nilai'),
				'file' => $file->getName()
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
         $model = new TugasModel();
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

}