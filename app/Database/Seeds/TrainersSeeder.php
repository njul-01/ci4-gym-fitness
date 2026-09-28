<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TrainersSeeder extends Seeder
{
    public function run()
    {
         $data = [
        ['name' =>'Hulk Haya',
        'phone' => '085286953970',
        'email' => 'hulk@gmail.com',
        'speciality' => 'Pilates',
        ],

        ['name' =>'Iron',
        'phone' => '085286953971',
        'email' => 'iron@gmail.com',
        'speciality' => 'Boxing',
        ],

        ['name' =>'Thor Odinson',
        'phone' => '085286953972',
        'email' => 'odin@gmail.com',
        'speciality' => 'Cardio',
        ],

        ['name' =>'Steve Rogers',
        'phone' => '085286953973',
        'email' => 'steve@gmail.com',
        'speciality' => 'Yoga',
        ],

       
    ];

       $this->db->table('trainers')->insertBatch($data); 
    }
}
