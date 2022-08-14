<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class UserModel extends Model{
    protected $table = 'users';
<<<<<<< HEAD
    protected $useSoftDeletes = true;
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $allowedFields = ['nik','username','no_hp','nama','email','password','level'];
=======
    protected $allowedFields = ['email','password','level'];
>>>>>>> 87df145796cd6864b5e6c5f0a6900f71b5dc3066
}