<?php

namespace App\Models;

use CodeIgniter\Model;

class ClassesModel extends Model
{
    protected $table      = 'classes';
    protected $primaryKey = 'class_id';

    protected $allowedFields = [
        'class_name',
        'description',
        'capacity',
        'is_active',
        'cover',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;

    // Ambil kelas aktif (dipakai di Trainer)
    public function getActiveClasses()
    {
        return $this->where('is_active', 1)->findAll();
    }

    // Search + pagination (dipakai di halaman Classes)
    public function search($perPage, $group, $keyword = null)
    {
        $builder = $this->select('classes.*')
                        ->orderBy('classes.is_active', 'DESC');

        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('classes.class_name', $keyword)
                ->orLike('classes.description', $keyword)
                ->orLike('classes.capacity', $keyword)
                ->orLike('classes.is_active', $keyword)
                ->orLike('classes.cover', $keyword)
                ->groupEnd();
        }

        return $builder->paginate($perPage, $group);
    }
}
