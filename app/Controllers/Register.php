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
            'nik'           => 'required',
            'nama'          => 'required|min_length[3]',
            'username'      => 'required|min_length[3]',
            'no_hp'         => 'required|min_length[11]',
            'email'         => 'required|valid_email|is_unique[users.email]',
            'password'      => 'required|min_length[6]|max_length[200]',
            'level'         =>'required'
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
            $model = new UserModel();
            $data = [
                'nik'      => $this->request->getVar('nik'),
                'nama'     => $this->request->getVar('nama'),
                'username' => $this->request->getVar('username'),
                'no_hp'    => $this->request->getVar('no_hp'),
                'email'    => $this->request->getVar('email'),
                'password' => $this->request->getVar('password'),
<<<<<<< HEAD
                'level'    => ('3')
            ];
            $registered = $model->save($data);
            return $this->respond($registered);
        
    }

    public function registerPengajar(){
        helper(['form']);

        $rules = [
            'nik'           => 'required',
            'nama'          => 'required|min_length[3]',
            'username'      => 'required|min_length[3]',
            'no_hp'         => 'required|min_length[11]',
            'email'         => 'required|valid_email|is_unique[users.email]',
            'password'      => 'required|min_length[6]|max_length[200]'
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
            $model = new UserModel();
            $data = [
                'nik'      => $this->request->getVar('nik'),
                'nama'     => $this->request->getVar('nama'),
                'username' => $this->request->getVar('username'),
                'no_hp'    => $this->request->getVar('no_hp'),
                'email'    => $this->request->getVar('email'),
                'password' => $this->request->getVar('password'),
                'level'    => ('2')
=======
                'level'    => $this->request->getVar('level')
>>>>>>> 87df145796cd6864b5e6c5f0a6900f71b5dc3066
            ];
            $registered = $model->save($data);
            return $this->respond($registered);
        
    }
}
