<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClassesModel;
use App\Models\TrainersModel;

class TrainersController extends BaseController
{
    protected $trainersModel;
    protected $classesModel;

    public function __construct()
    {
        $this->trainersModel = new TrainersModel();
        $this->classesModel  = new ClassesModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        return view('trainers/index', [
            'title'     => 'Trainer',
            'subtitle'  => 'Data Trainer',
            'trainers'  => $this->trainersModel->search(5, 'trainers', $keyword),
            'pager'     => $this->trainersModel->pager,
            'perPage'   => 10,
            'keyword'   => $keyword,
        ]);
    }

    public function create()
    {
        return view('trainers/create', [
            'title'    => 'Trainer',
            'subtitle' => 'Tambah Data Trainer',
            'classes'  => $this->classesModel
                ->where('is_active', 1)
                ->findAll(),
        ]);
    }

    public function insert()
    {
        $speciality = $this->request->getPost('speciality');
       
        $specialityString = $speciality ? implode(',', $speciality) : null;

        $this->trainersModel->insert([
            'name'       => $this->request->getPost('name'),
            'phone'      => $this->request->getPost('phone'),
            'email'      => $this->request->getPost('email'),
            'speciality' => $specialityString,
            'status'     => 'Active',
        ]);

        return redirect()->to('/trainers')
            ->with('success', 'Trainer berhasil disimpan');
    }

    public function edit($id)
    {
        return view('trainers/edit', [
            'title'    => 'Trainer',
            'subtitle' => 'Edit Data Trainer',
            'trainers' => $this->trainersModel->find($id),
            'classes'  => $this->classesModel
                ->where('is_active', 1)
                ->findAll(),
        ]);
    }

    public function update($id)
    {
        $speciality = $this->request->getPost('speciality');

       
        $specialityString = $speciality ? implode(',', $speciality) : null;

        $this->trainersModel->update($id, [
            'name'       => $this->request->getPost('name'),
            'phone'      => $this->request->getPost('phone'),
            'email'      => $this->request->getPost('email'),
            'speciality' => $specialityString,
        ]);

        return redirect()->to('/trainers')
            ->with('success', 'Data trainer berhasil diupdate');
    }

    public function inactive($id)
    {
        $this->trainersModel->update($id, ['status' => 'Inactive']);

        return redirect()->to('/trainers')
            ->with('success', 'Trainer berhasil di-nonaktifkan');
    }

    public function active($id)
    {
        $this->trainersModel->update($id, ['status' => 'Active']);

        return redirect()->to('/trainers')
            ->with('success', 'Trainer berhasil diaktifkan');
    }
}
