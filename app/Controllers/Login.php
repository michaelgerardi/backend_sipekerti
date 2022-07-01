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

    // public function coba_multiuser(){
    //     session_start();
    //     $username = $_POST['username'];
    //     $password = $_POST['password'];
    //     $user = mysqli_query($koneksi, "select * from user where username='$username' and password='$password'");
    //     $cek = mysqli_num_rows($user);
    //     if($cek > 0){
    //         $data = mysqli_fetch_assoc($user);
    //         //buat session username dan levelnya
    //         if($data['level'] == 'admin'){
    //             $_SESSION['username'] = $username;
    //             $_SESSION['level'] = 'admin';
    //             return $this.respond($data);
    //         }elseif($data['level'] == 'pengajar'){
    //             $_SESSION['username'] = $username;
    //             $_SESSION['level'] = 'pengajar';
    //             return $this.respond($data);
    //         }elseif($data['level']== 'dosen'){
    //             $_SESSION['username'] = $username;
    //             $_SESSION['level'] = 'dosen';
    //             return $this.respond($data);
    //         }
    //     }

    // }
}