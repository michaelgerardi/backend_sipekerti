<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class Register extends Controller
{

    use ResponseTrait;
    public function register(){
        helper(['form']);

        $rules = [
            'email'         => 'required|valid_email|is_unique[users.email]',
            'password'      => 'required|min_length[6]|max_length[200]'
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
            $model = new UserModel();
            $data = [
                'email'    => $this->request->getVar('email'),
                'password' => $this->request->getVar('password')
            ];
            $registered = $model->save($data);
            return $this->respond($registered);
        
    }
}
