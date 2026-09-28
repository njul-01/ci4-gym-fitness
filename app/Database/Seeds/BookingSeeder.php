<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run()
    {
        $data = [
        ['member_id' => 1,
        'schedule_id' => 1,
        'booking_time' => '09:00:00',
        'status' => 'Booked' ],

        ['member_id' => 2,
        'schedule_id' => 1,
        'booking_time' => '09:15:00',
        'status' => 'Booked' ],

        ['member_id' => 3,
        'schedule_id' => 1,
        'booking_time' => '09:30:00',
        'status' => 'Booked' ],

        ['member_id' => 4,
        'schedule_id' => 1,
        'booking_time' => '09:45:00',
        'status' => 'Booked' ],

        ['member_id' => 5,
        'schedule_id' => 1,
        'booking_time' => '10:00:00',
        'status' => 'Booked' ],
    ];

       $this->db->table('classbooking')->insertBatch($data); 
    }
}
