<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table            = 'classbooking';
    protected $primaryKey       = 'booking_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'schedule_id',
        'member_id',
        'booking_time',
        'status',
    ];

    // Dates
    protected $useTimestamps = true;
         public function getbookingById($idSchedule)
    {
        return $this->select('classbooking.*, members.name')
        ->join('members','members.member_id = classbooking.member_id','left')
        ->where('schedule_id', $idSchedule)
        ->findAll();
    }

    public function countBooked($schedule_id)
{
    return $this->where('schedule_id', $schedule_id)
        ->where('status', 'Booked')
        ->countAllResults();
}
}
