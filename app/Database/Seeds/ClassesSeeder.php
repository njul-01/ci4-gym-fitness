<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClassesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'class_name' => 'Yoga',
                'description' => 'dirancang untuk meningkatkan fleksibilitas, keseimbangan, dan ketenangan pikiran melalui gerakan dan pernapasan',
                'capacity' => 12,
                'is_active' => true
            ],

            [
                'class_name' => 'Zumba',
                'description' => 'dirancang untuk membakar kalori dengan gerakan tarian energik yang menyenangkan dan irama musik',
                'capacity' => 20,
                'is_active' => true
            ],

            [
                'class_name' => 'HIIT',
                'description' => 'dirancang untuk meningkatkan kekuatan dan stamina melalui latihan intensitas tinggi dengan waktu singkat',
                'capacity' => 15,
                'is_active' => false
            ],

            [
                'class_name' => 'Pilates',
                'description' => 'dirancang untuk memperkuat otot inti, meningkatkan postur, dan fleksibilitas melalui latihan terkontrol',
                'capacity' => 10,
                'is_active' => true
            ],

            [
                'class_name' => 'Spinning',
                'description' => 'dirancang untuk meningkatkan kebugaran kardiovaskular melalui latihan sepeda statis dengan intensitas yang dapat disesuaikan',
                'capacity' => 18,
                'is_active' => true
            ],

            [
                'class_name' => 'Body Pump',
                'description' => 'dirancang untuk membangun kekuatan otot dan daya tahan melalui latihan beban dengan repetisi tinggi',
                'capacity' => 14,
                'is_active' => false
            ],

            [
                'class_name' => 'CrossFit',
                'description' => 'dirancang untuk meningkatkan kebugaran secara keseluruhan melalui kombinasi latihan kekuatan, kardio, dan fungsional',
                'capacity' => 16,
                'is_active' => true
            ],

            [
                'class_name' => 'Boxing',
                'description' => 'dirancang untuk meningkatkan kekuatan, koordinasi, dan kebugaran kardiovaskular melalui latihan tinju',
                'capacity' => 12,
                'is_active' => true
            ],
        ];

        $this->db->table('classes')->insertBatch($data);
    }
}
