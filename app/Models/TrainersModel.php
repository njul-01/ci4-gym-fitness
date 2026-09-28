<?php

namespace App\Models;

use CodeIgniter\Model;

class TrainersModel extends Model
{
    protected $table            = 'trainers';
    protected $primaryKey       = 'trainer_id';
    protected $useAutoIncrement = true;
    //protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'phone',
        'email',
        'speciality',
        'status'
    ];



    // Dates
    protected $useTimestamps = true;

    public function search($perPage = 5, $group, $keyword = null)
    {
        $builder = $this->select('trainers.*')
        ->orderBy('status', 'ASC');
    if(!empty($keyword)) {
            $builder= $builder->groupStart()
            ->like('name', $keyword)
            ->orLike('phone', $keyword)
            ->orLike('email', $keyword)
            ->orLike('speciality', $keyword)
            ->orLike('status', $keyword)
            ->groupEnd();
        }

        return $builder->paginate($perPage, $group);
    } 

    public function getActiveTrainers()
    {
         return $this->where('status', 'Active')->findAll();
    }
}
