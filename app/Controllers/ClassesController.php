<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Exceptions\PageNotFoundException;

use App\Models\ClassesModel;

class ClassesController extends BaseController
{

protected $classesModel;
    public function __construct()
    {
        $this->classesModel = new ClassesModel();
    } 


    public function index()
    {
        $classesModel = new ClassesModel();
        $keyword = $this->request->getGet('keyword');
        $data = [
            'title'     => 'Classes',
            'subtitle'  => 'Data Class',
            'classes'   => $this->classesModel->search(10, 'classes', $keyword),
            'pager'     => $this->classesModel->pager,
            'perPage'   => 10,
            'keyword'   => $keyword,
        ];
        return view('classes/index', $data);
    }

    public function create()
    {
        $classModel = new ClassesModel();

        $data = [
            'title' => 'Trainer',
            'subtitle' => 'Tambah Trainer',
            'classes' => $classModel->findAll(), 
        ];

        return view('classes/create', $data);
    }

    public function insert()
    {
        $classesModel = new ClassesModel();

        // ambil gambar dari form
        $coverFile = $this->request->getFile('cover');
        $coverName = null;

        if($coverFile && $coverFile->isValid() && !$coverFile->hasMoved()) {
            $coverName = $coverFile->getRandomName();
            $coverFile->move(FCPATH. 'image/cover', $coverName);
        }

        $is_active = $this->request->getPost('is_active');
        if (!in_array($is_active, ['1', '0'])) {
            $is_active = '0';
        }

        $classesModel->insert([
            'class_name'    => $this->request->getPost('class_name'),
            'description'   => $this->request->getPost('description'),
            'capacity'      => $this->request->getPost('capacity'),
            'is_active'     => $is_active,
            'cover'         => $coverName,
        ]);
        return redirect()->to('/classes')->with('success', 'Data class berhasil disimpan');
    }

     // Menonaktifkan is active classes
    public function no($id)
    {   
        $this->classesModel->update($id, [
            'is_active' => 0 ,
        ]);
        return redirect()->to('/classes')->with('success', 'Data Class Berhasil Di Nonaktifkan');
    }

    //mengaktifkan is active classes
     public function yes($id)
    {   
        $this->classesModel->update($id, [
            'is_active' => 1,
        ]);
        return redirect()->to('/classes')->with('success', 'Data Class Berhasil Di Aktifkan');
    }


    public function edit($id)
    {
        $classesModel = new ClassesModel();
        $data = [
            'title'     => 'Classes',
            'subtitle'  => 'Edit Data Class',
            'classes'   => $this->classesModel->find($id),
        ];

        return view('classes/edit', $data);
    }

    public function update($id)
    {
        $classesModel = new ClassesModel();

        // nama cover lama jika tidak diupdate
        $coverLama = $this->request->getPost('cover_lama');
        $coverFile = $this->request->getFile('cover');
        $coverName = $coverLama;

        if($coverFile && $coverFile->isValid() && !$coverFile->hasMoved()) {
            $newName = $coverFile->getRandomName();
            $coverFile->move(FCPATH. 'image/cover', $newName);

            // hapus cover lama
            if(!empty($coverLama) && file_exists(FCPATH . 'image/cover/' . $coverLama)) {
                @unlink(FCPATH . 'image/cover/' . $coverLama);
            }
            $coverName = $newName;
        }

        $is_active = $this->request->getPost('is_active');
        if (!in_array($is_active, ['1', '0'])) {
            $is_active = '0';
        }

        $classesModel->update($id, [
            'class_name'    => $this->request->getPost('class_name'),
            'description'   => $this->request->getPost('description'),
            'capacity'      => $this->request->getPost('capacity'),
            'cover'         => $coverName,
        ]);

        return redirect()->to('/classes')->with('success', 'Data Class Berhasil diupdate');
    }

}