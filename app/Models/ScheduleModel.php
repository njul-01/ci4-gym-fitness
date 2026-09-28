<?php

namespace App\Models;

use CodeIgniter\Model;

class ScheduleModel extends Model
{
    protected $table            = 'schedule';
    protected $primaryKey       = 'schedule_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'class_id',
        'trainer_id',
        'schedule_date',
        'start_time',
        'end_time',
        'status',
    ];

    // Dates
    protected $useTimestamps = true;

       public function getSchedule($perPage, $group, $keyword = null)
    {
        $builder = $this->select('schedule.*, trainers.name, classes.class_name, classes.capacity')
                        ->join('trainers','trainers.trainer_id = schedule.trainer_id','left')
                        ->join('classes','classes.class_id = schedule.class_id','left')
                        ->join('classbooking','classbooking.schedule_id = schedule.schedule_id', 'left')
                        ->groupBy('schedule.schedule_id');
        
        if(!empty($keyword))
        {
            $builder->groupStart()
                    ->like('trainers.name', $keyword)
                     ->orLike('classes.class_name', $keyword)
                    ->orLike('schedule.status', $keyword)
                    ->groupEnd();
        }
        return $builder->paginate($perPage, $group);
    }
    public function getHeaderById($id)
    {
        return $this->select('schedule.*, trainers.name, classes.class_name, classes.capacity')
        ->join('trainers','trainers.trainer_id = schedule.trainer_id','left')
        ->join('classes', 'classes.class_id = schedule.class_id', 'left')
        ->where('schedule.schedule_id', $id)
        ->first();
    }

    public function hasActiveSchedule($class_id)
{
    return $this->where('class_id', $class_id)
        ->whereIn('status', ['Upcoming', 'On going'])
        ->first();
}

public function hasTrainerTimeConflict(
    $trainer_id,
    $schedule_date,
    $start_time,
    $end_time
) {
    return $this->where('trainer_id', $trainer_id)
        ->where('schedule_date', $schedule_date)
        ->whereIn('status', ['Upcoming', 'On going'])
        ->groupStart()
            ->where('start_time <', $end_time)
            ->where('end_time >', $start_time)
        ->groupEnd()
        ->first();
}


public function getLaporanScheduleBulanan($bulan, $tahun)
{
    return $this->db->table('schedule cs')
        ->select('
            cs.schedule_date,
            c.class_name,
            t.name,
            cs.start_time,
            cs.end_time,
            c.capacity,
            COUNT(cb.booking_id) as total_booking
        ')
        ->join('classes c', 'c.class_id = cs.class_id')
        ->join('trainers t', 't.trainer_id = cs.trainer_id')
        ->join('classbooking cb', 'cb.schedule_id = cs.schedule_id AND cb.status != "Canceled"', 'left')
        ->where('MONTH(cs.schedule_date)', $bulan)
        ->where('YEAR(cs.schedule_date)', $tahun)
        ->groupBy('cs.schedule_id')
        ->orderBy('cs.schedule_date', 'ASC')
        ->get()->getResultArray();
}
 
}



                                                                                                            