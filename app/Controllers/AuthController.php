<?php

namespace App\Controllers;

Use App\Models\UsersModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $usersModel;  

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }
    public function login()
    {
        return view('auth/login');
    }

    public function doLogin(){
        $username = $this->request->getPost('username');
        $pasword = $this->request->getPost('password');

        $user = $this->usersModel->getByUsername($username);

        if(!$user) {
            return redirect()->back()->with('error', 'Username tidak ditemukan');
        }

        if(!password_verify($pasword, $user['password'])){
            return redirect()->back()->with('error','Password salah');
        }

        // simpan data user dan role di session
        session()->set([
            'isLogin' => true,
            'user_id' => $user['id'],
            'nama' => $user['nama'],
            'role' => $user['role'],
        ]);

        return redirect()->to('/');
    }

    public function logout(){
        session()->destroy();
        return redirect()->to('/login');
    }
}
