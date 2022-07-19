<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Database\BaseBuilder;
 
class Login extends Controller
{
    public $db;
    public function __construct()
	{
		$this->db = \Config\Database::connect();
	}
    

    use ResponseTrait;
    public function auth(){
        helper(['form']);
        $session = session();
        $model = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $model->where('email', $email)->first();
        if($data){
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if($verify_pass);
                $ses_data = [
                    'id'       => $data['id'],
                    'email'    => $data['email'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                return $this->respond($data);        
        }else{
            return $this->respond('Gagal login');
        }
    }


    public function select_level(){
        $model = new UserModel();
        $data = $model->where('level',3)->findAll();
      return $this->respond($data, 200);
    }

    public function select_level2(){
        $model = new UserModel();
        $data = $model->where('level',2)->findAll();
      return $this->respond($data, 200);
    }
  
}