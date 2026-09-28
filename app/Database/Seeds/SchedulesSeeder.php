<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SchedulesSeeder extends Seeder
{
    public function run()
    {
         $data = [
        ['class_name' =>'Yoga',
        'trainer_id' => 4,
        'schedule_date' => '2025-12-10',
        'start_time' => '10:00:00',
        'end_time' => '11:00:00',
        'status' => 'Upcoming' ],
    ];

       $this->db->table('schedule')->insertBatch($data); 
    }
}
