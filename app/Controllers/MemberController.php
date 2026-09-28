<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\MemberModel;
use App\Models\MembershipModel;

class MemberController extends BaseController
{
    protected $memberModel;
    protected $membershipModel;
    public function __construct()
    {
        $this->memberModel = new MemberModel();
        $this->membershipModel = new MembershipModel();
    }

    // Menampilkan data member dengan pagination
    public function index()
    {
        $memberModel = new MemberModel();
        $keyword = $this->request->getGet('keyword');
        $data = [
            'title'     => 'Member',
            'subtitle'  => 'Data Member',
            'members'   => $this->memberModel->search(10, 'members',$keyword),
            'pager'     => $this->memberModel->pager,
            'perPage'   => 10,
            'keyword'   => $keyword,
        ]; //join table dari model
        return view('members/index', $data);
    }

    // Menampilkan form tambah data member
    public function create(){
        $data = [
            'title'     => 'member',
            'subtitle'  => 'Tambah Data Member',
        ];
        return view('members/create', $data);
    }

    // Menyimpan data member baru
    public function insert()
    {
        $memberModel = new MemberModel();
        $memberModel->insert([
            'member_code' => $this->request->getPost('member_code'),
            'name'        => $this->request->getPost('name'),
            'phone'       => $this->request->getPost('phone'),
            'email'       => $this->request->getPost('email'),
            'join_date'   => $this->request->getPost('join_date'),
            'status'      => 'Active',
        ]);
        return redirect()->to('/members')->with('success', 'Data member berhasil disimpan');
    }

    // Menonaktifkan Status member
    public function inactive($id)
{
    // cek apakah member masih punya membership aktif atau inactive
    $activeMembership = $this->membershipModel
        ->where('member_id', $id)
       ->whereIn('status', ['active', 'inactive'])
        ->first();

    if ($activeMembership) {
        return redirect()->to('/members')
            ->with('error', 'Member masih memiliki membership aktif/belum expired');
    }

    // jika tidak ada membership aktif/belum expired, boleh inactive
    $this->memberModel->update($id, [
        'status' => 'Inactive',
    ]);

    return redirect()->to('/members')
        ->with('success', 'Data Member Berhasil Di Inactive');
}

    // Mengaktifkan Status member
    public function Active($id)
    {
        $this->memberModel->update($id, [
            'status' => 'Active',
        ]);
        return redirect()->to('/members')->with('success', 'Data Member Berhasil Di Active');
    }

    // Menampilkan form edit data member    
     public function edit($id){
        $memberModel = new MemberModel();
         $data = [
            'title' => 'Member',
            'subtitle' => 'Edit Data Member',
            'members' => $memberModel->find($id),
         ];

         return view('members/edit', $data);
    }

    // Memperbarui data member
     public function update($id)
     {
        $memberModel = new MemberModel();
        $keyword = $this->request->getGet('keyword');
        $status = $this->request->getPost('status');

            $memberModel->update($id,[
                'member_code' => $this->request->getPost('member_code'),
                'name'      => $this->request->getPost('name'),
                'phone'     => $this->request->getPost('phone'),
                'email'     => $this->request->getPost('email'),
                'join_date' => $this->request->getPost('join_date'),
       ]);
         return redirect()->to('/members')->with('success', 'Data member Berhasil diupdate');
     }
}