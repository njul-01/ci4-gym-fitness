<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\MembershipModel;
use App\Models\MemberModel;

class MembershipController extends BaseController
{
     protected $memberModel;
    protected $membershipModel;
    public function __construct()
    {
        $this->membershipModel = new MembershipModel();
        $this->memberModel = new MemberModel();
    }

 private function syncMembershipStatus()
{
    $today = date('Y-m-d');

    // Expired
    $this->membershipModel
        ->where('end_date <', $today)
        ->set(['status' => 'Expired'])
        ->update();

    // Active
    $this->membershipModel
        ->where('start_date <=', $today)
        ->where('end_date >=', $today)
        ->set(['status' => 'Active'])
        ->update();

    // Inactive (belum mulai)
    $this->membershipModel
        ->where('start_date >', $today)
        ->set(['status' => 'Inactive'])
        ->update();
}

    public function index()
    {
        $membershipModel = new MembershipModel();
        $this->syncMembershipStatus(); // Menyinkronkan status membership sebelum menampilkan data
        $keyword = $this->request->getGet('keyword');
        $data = [
            'title' => 'membership',
            'subtitle' => 'Data Membership',
            'membership' => $this->membershipModel->getMembership(10, 'membership', $keyword),
            'pager' => $this->membershipModel->pager,
            'perPage' => 10,
            'keyword' => $keyword,
        ];
        return view('membership/index', $data); //mengirimkan data ke folder buku/index.php
    }

    public function create() {
        $memberModel = new MemberModel();
        $this->syncMembershipStatus(); // Menyinkronkan status membership sebelum menampilkan form
        $data = [
            'title' => 'Membership',
            'subtitle' => 'Tambah Data Membership',
            'members' => $this->memberModel->getMembersForNewMembership(),
        ];
        return view('membership/create', $data);
    }

    public function insert(){
    $membershipModel = new MembershipModel();
    $this->syncMembershipStatus();
    $member_id  = $this->request->getPost('member_id');
    $type       = $this->request->getPost('type');
    $start_date = $this->request->getPost('start_date');
    $today = date('Y-m-d');

    //  1. Cek membership aktif
    if ($this->membershipModel->hasActiveOrInactive($member_id)) { // Memeriksa apakah member sudah memiliki membership aktif atau terjadwal
    return redirect()->back()
        ->with('error', 'Member sudah memiliki membership aktif / terjadwal')
        ->withInput();
    }

    //  2. Tentukan harga & durasi
    switch ($type) {
        case 'bronze':
            $price = 150000;
            $duration = 30;
            break;
        case 'silver':
            $price = 200000;
            $duration = 60;
            break;
        case 'gold':
            $price = 300000;
            $duration = 90;
            break;
        default:
            return redirect()->back()->with('error', 'Tipe membership tidak valid');
    }

    // 3. Hitung end_date
    $end_date = date('Y-m-d', strtotime($start_date . " +{$duration} days")); // Menghitung tanggal akhir berdasarkan durasi

 if ($today < $start_date) {
    $status = 'Inactive';
} elseif ($today >= $start_date && $today <= $end_date) {
    $status = 'Active';
} else {
    $status = 'Expired';
}


    // 5. Simpan
    $membershipModel->insert([
        'member_id'  => $member_id,
        'type'       => $type,
        'start_date' => $start_date,
        'end_date'   => $end_date,
        'price'      => $price,
        'status'     => $status,
    ]);
    return redirect()->to('/membership')->with('success', 'Membership berhasil ditambahkan');
    }


    public function edit($id)
    {
    $membershipModel = new MembershipModel();
    $memberModel = new MemberModel();
    $this->syncMembershipStatus();
    $data = [
        'title' => 'Membership',
        'subtitle' => 'Edit Data Membership',
        'membership' => $membershipModel->find($id),
        'members' => $memberModel->where('status', 'Active')->findAll(),
    ];
    return view('membership/edit', $data);
    }


    public function update($id)
    {
    $membershipModel = new MembershipModel();
    $this->syncMembershipStatus();
    $member_id  = $this->request->getPost('member_id');
    $type       = $this->request->getPost('type');
    $start_date = $this->request->getPost('start_date');
    $today = date('Y-m-d');

    // 🔒 1. Cek membership aktif
    if ($this->membershipModel->hasActiveOrInactive($member_id, $id)) {
    return redirect()->back()
        ->with('error', 'Member sudah memiliki membership aktif / terjadwal')
        ->withInput();
    }

    // 2. Tentukan harga & durasi
    switch ($type) {
        case 'bronze':
            $price = 150000;
            $duration = 30;
            break;
        case 'silver':
            $price = 200000;
            $duration = 60;
            break;
        case 'gold':
            $price = 300000;
            $duration = 90;
            break;
        default:
            return redirect()->back()->with('error', 'Tipe membership tidak valid');
    }

    // 3. Hitung end_date
    $end_date = date('Y-m-d', strtotime($start_date . " +{$duration} days"));

  if ($today < $start_date) {
    $status = 'Inactive';
} elseif ($today >= $start_date && $today <= $end_date) {
    $status = 'Active';
} else {
    $status = 'Expired';
}


    // 5. Simpan
    $membershipModel->update($id,[
        'member_id'  => $member_id,
        'type'       => $type,
        'start_date' => $start_date,
        'end_date'   => $end_date,
        'price'      => $price,
        'status'     => $status,
    ]);
    return redirect()->to('/membership')->with('success', 'Membership berhasil diperbarui');
    }
}