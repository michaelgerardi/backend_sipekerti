<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Database\BaseBuilder;
 
class Login extends Controller
{
    public function __construct()
	{
		$this->db = \Config\Database::connect();
	}

    use ResponseTrait;
    public function auth(){
        helper(['form']);
        $session = session();
        $model = new UserModel();
        $username = $this->request->getVar('username');
        //$email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $level = $this->request->getVar('level');
        $data = $model->where('username', $username)->first();
        if($data){
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if($verify_pass);
                $ses_data = [
                    'id'       => $data['id'],
                    'username' => $data['username'],
                    'level'     => $data['level'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                return $this->respond($data);        
        }else{
            return $this->respond('Gagal login');
        }
    }

    public function delete($id = null)
      {
          $model = new UserModel();
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

    public function update($id = null)
      {
          $model = new UserModel();
          $json = $this->request->getJSON();
          if($json){
              $data = [
                  'nik' => $json->nik,
                  'nama' => $json->nama,
                  'username' => $json->username,
                  'no_hp' =>$json->no_hp,
                  'email'=>$json->email,
                  'password'=>$json->password
              ];
          }else{
              $input = $this->request->getRawInput();
              $data = [
                  'nik' => $input['nik'],
                  'nama' => $input['nama'],
                  'username' => $input['username'],
                  'no_hp'=>$input['no_hp'],
                  'email'=>$input['email'],
                  'password'=>$input['password']
              ];
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

      public function getuser()
      {
        return $this->respond(session());
      }
}