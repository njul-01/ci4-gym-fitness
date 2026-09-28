<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MembersSeeder extends Seeder
{
    public function run()
    {
         $data = [
        ['member_code' =>'M0001',
        'name' => 'Zhuge Liang',
        'phone' => '081234749678',
        'email' => 'Zhu@gmail.com',
        'join_date' => '2025/12/19',
        'status' => 'Active' ],        

        ['member_code' =>'M0002',
        'name' => 'Guan Yu',
        'phone' => '081234749679',
        'email' => 'Gua@gmail.com',
        'join_date' => '2025/12/20',
        'status' => 'Active' ],
        
        ['member_code' =>'M0003',
        'name' => 'Liu Bei',
        'phone' => '081234749680',
        'email' => 'Bei@gmail.com',
        'join_date' => '2025/12/21',
        'status' => 'Active'
        ],
        
        ['member_code' =>'M0004',
        'name' => 'Cao Cao',
        'phone' => '081234749681',
        'email' => 'cao@gmail.com',
        'join_date' => '2025/12/22',
        'status' => 'Active'
        ],

        ['member_code' =>'M0005',
        'name' => 'Sun Quan',
        'phone' => '081234749682',
        'email' => 'sun@gmail.com',
        'join_date' => '2025/12/23',
        'status' => 'Active'
        ],

        ['member_code' =>'M0006',
        'name' => 'Dong Zhuo',
        'phone' => '081234749683',
        'email' => 'dong@gmail.com',
        'join_date' => '2025/12/24',
        'status' => 'Active'
        ],

        ['member_code' =>'M0007',
        'name' => 'Lu Bu',
        'phone' => '081234749684',
        'email' => 'lubu@gmail.com',
        'join_date' => '2025/12/25',
        'status' => 'Active'
        ],

        ['member_code' =>'M0008',
        'name' => 'Zhang Fei',
        'phone' => '081234749685',
        'email' => 'fei@gmail.com',
        'join_date' => '2025/12/26',
        'status' => 'Active'
        ],

        ['member_code' =>'M0009',
        'name' => 'Ma Chao',
        'phone' => '081234749686',
        'email' => 'ma@gmail.com',
        'join_date' => '2025/12/27',
        'status' => 'Inactive'
        ],

        ['member_code' =>'M0010',
        'name' => 'Huang Zhong',
        'phone' => '081234749687',
        'email' => 'zhong@gmail.com',
        'join_date' => '2025/12/28',
        'status' => 'Inactive'
        ],
    ];

       $this->db->table('members')->insertBatch($data); 
    }
}
