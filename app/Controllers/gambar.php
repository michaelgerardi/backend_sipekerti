<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\gambarModel;

class gambar extends ResourceController
{

    protected $modelName = 'App\Models\gambarModel';
    use ResponseTrait;
    public $db;

    // get all gambar
    public function index()
    {
        $model = new gambarModel();
        $data = $model->findall();
        return $this->respond($data, 200);
    }   

    public function inputgambar(){
        helper(['form']);

		$rules = [
		// 	// 'id_pertemuan' => '',
		 	'gambar' =>  'uploaded[gambar]|max_size[gambar, 2000]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]'
		 ];

		 if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else
         {

			$file = $this->request->getFile('gambar');
			if(! $file->isValid())
			return $this->fail($file->getErrorString());
			 $file->move('./assets/uploads');
			 $data = [
			// 	// 'id_pertemuan' => $this->request->getPost('id_pertemuan'),
				'gambar' => $file->getName()
			];

			$id = $this->model->insert($data);
			$data['id'] = $id;
		return $this->respondCreated($data);
		}
    }
}