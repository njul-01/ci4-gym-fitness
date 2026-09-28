<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MembershipSeeder extends Seeder
{
    public function run()
    {
         $data = [
        ['member_id' => 1,
        'type' => 'Bronze',
        'start_date' => '2025/12/31',
        'end_date' => '2025/12/30',
        'price' => 150000,
        'status' => 'Active' ],
        
         ['member_id' => 2,
        'type' => 'Bronze',
        'start_date' => '2025/12/31',
        'end_date' => '2025/12/31',
        'price' => 150000,
        'status' => 'Active' ],

         ['member_id' => 3,
        'type' => 'Bronze',
        'start_date' => '2025/12/01',
        'end_date' => '2025/12/30',
        'price' => 150000,
        'status' => 'Active' ],

         ['member_id' => 4,
        'type' => 'Silver',
        'start_date' => '2025/12/31',
        'end_date' => '2026/02/30',
        'price' => 250000,
        'status' => 'Active' ],

         ['member_id' => 5, 
        'type' => 'Gold',
        'start_date' => '2025/12/31',
        'end_date' => '2026/03/30',
        'price' => 350000,
        'status' => 'Active' ],
    ];

       $this->db->table('membership')->insertBatch($data); 
    }
}
