<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
           $data = [
        ['nama' =>'Staff Gym & Fitness',
        'username' => 'staff',
        'password' => password_hash('12345', PASSWORD_DEFAULT),
        'role' => 'staff'
        ],

          ['nama' =>'Kepala Gym & Fitness',
        'username' => 'kepala',
        'password' => password_hash('12345', PASSWORD_DEFAULT),
        'role' => 'kepala'
        ],
    ];

    $this->db->table('users')->insertBatch($data);
    }
}
