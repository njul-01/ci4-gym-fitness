<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'username', 'password', 'role'];

     public function getByUsername($username){
        return $this->where('username', $username)->first();
    }
   
}
