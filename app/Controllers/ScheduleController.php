<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Pdf;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\ScheduleModel;
use App\Models\TrainersModel;
use App\Models\BookingModel;
use App\Models\ClassesModel;
use App\Models\MemberModel;
use App\Models\MembershipModel;


class ScheduleController extends BaseController
{

    protected $trainersModel;
    protected $bookingModel;
    protected $classesModel;
    protected $memberModel;
    protected $scheduleModel;
    protected $membershipModel;

    public function __construct()
    {
        $this->trainersModel = new TrainersModel();
        $this->bookingModel = new BookingModel();
        $this->classesModel = new ClassesModel();
        $this->memberModel = new MemberModel();
        $this->scheduleModel = new ScheduleModel();
        $this->membershipModel = new MembershipModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $data = [
            'title' => 'Schedule',
            'subtitle' => 'Data Schedule',
            'schedules' => $this->scheduleModel->getSchedule(10, 'schedules', $keyword),
            'pager' => $this->scheduleModel->pager,
            'perPage' => 10,
            'keyword' => $keyword,
        ];
        return view('schedule/index', $data);
    }

    public function create() {

        $data = [
            'title' => 'Schedule',
            'subtitle' => 'Tambah Data Schedule',
            'trainers' => $this->trainersModel->getActiveTrainers(),
            'classes' => $this->classesModel->getActiveClasses(),
        ];

        return view('schedule/create', $data);
    }

    public function getTrainerByClass($class_id)
{
    $class = $this->classesModel->find($class_id);

    if (!$class) {
        return $this->response->setJSON([]);
    }

    $className = strtolower($class['class_name']);

    $trainers = $this->trainersModel->getActiveTrainers();

    $filtered = [];

    foreach ($trainers as $trainer) {
        $specialties = array_map(
            'trim',
            explode(',', strtolower($trainer['speciality']))
        );

        foreach ($specialties as $spec) {
            if (str_contains($className, $spec)) {
                $filtered[] = $trainer;
                break;
            }
        }
    }

    return $this->response->setJSON($filtered);
}

    public function insert(){
    $class_id      = $this->request->getPost('class_id');
    $trainer_id    = $this->request->getPost('trainer_id');
    $schedule_date = $this->request->getPost('schedule_date');
    $start_time    = $this->request->getPost('start_time');
    $end_time      = $this->request->getPost('end_time');

    // 🔒 CEK SCHEDULE AKTIF (punya kamu, JANGAN DIHAPUS)
    if ($this->scheduleModel->hasActiveSchedule($class_id)) {
        return redirect()->back()
            ->with('error', 'Kelas masih memiliki schedule aktif')
            ->withInput();
    }

    // CEK BENTROK JAM TRAINER
    $conflict = $this->scheduleModel->hasTrainerTimeConflict(
        $trainer_id,
        $schedule_date,
        $start_time,
        $end_time
    );

    if ($conflict) {
        return redirect()->back()
            ->with('error', 'Trainer memiliki jadwal lain yang bentrok')
            ->withInput();
    }


    // 🔥 VALIDASI SPESIALISASI

    $class   = $this->classesModel->find($class_id);
    $trainer = $this->trainersModel->find($trainer_id);

    if (!$class || !$trainer) {
        return redirect()->back()
            ->with('error', 'Data class atau trainer tidak valid')
            ->withInput();
    }

    $className = strtolower($class['class_name']);
    $specialties = array_map(
        'trim',
        explode(',', strtolower($trainer['speciality']))
    );

    $match = false;
    foreach ($specialties as $spec) {
        if (str_contains($className, $spec)) {
            $match = true;
            break;
        }
    }

    if (!$match) {
        return redirect()->back()
            ->with('error', 'Trainer tidak sesuai dengan spesialisasi kelas')
            ->withInput();
    }


    // INSERT SCHEDULE

        $this->scheduleModel->insert([
            'class_id' => $this->request->getPost('class_id'),
            'trainer_id' => $this->request->getPost('trainer_id'),
            'schedule_date' => $this->request->getPost('schedule_date'),
            'start_time' => $this->request->getPost('start_time'),
            'end_time' => $this->request->getPost('end_time'),
            'status' => 'Upcoming',
        ]);

        return redirect()->to('/schedule')->with('success', 'Data schedule berhasil ditambahkan.');
    }

      public function detail($id)
    {
        $header = $this->scheduleModel->getHeaderById($id);
        $detail = $this->bookingModel->getbookingById($id);
        $totalBooking = $this->bookingModel->countBooked($id);


        $data = [
            'title' =>'Schedule',
            'subtitle' => 'Detail Schedule',
            'header' => $header,
            'detail' => $detail,
            'totalBooking' => $totalBooking,
        ];

        return view('schedule/detail', $data);
    }
    

     public function booking($schedule_id) {
        $header = $this->scheduleModel->getHeaderById($schedule_id);
        $capacity = $header['capacity'];
        $current  = $this->bookingModel->countBooked($schedule_id);
        $sisa     = $capacity - $current;

         //  KUNCI STATUS
    if ($header['status'] !== 'Upcoming') {
        return redirect()
            ->to('/schedule/detail/'.$schedule_id)
            ->with('error', 'Booking hanya bisa dilakukan saat schedule Upcoming');
    }

    $data = [
        'title' => 'Booking Schedule',
        'subtitle' => 'Tambah Data Booking',
        'header' => $header,
        'member' => $this->memberModel->getMembersForBooking(),
        'trainer' => $this->trainersModel->findAll(),
        'sisa' => $sisa,
    ];

    return view('schedule/booking', $data);
    }

    public function bookinginsert($schedule_id)
    {
    $header   = $this->scheduleModel->getHeaderById($schedule_id);
    $capacity = $header['capacity'];
    $current  = $this->bookingModel->countBooked($schedule_id);
    $members  = $this->request->getPost('member_id');
    $incoming = count($members);

    if ($header['status'] !== 'Upcoming') {
    return redirect()
        ->to('/schedule/detail/'.$schedule_id)
        ->with('error', 'Schedule tidak bisa menerima booking');
    }

    if (($current + $incoming) > $capacity) {
        return redirect()->back()
            ->with('error', 'Jumlah booking melebihi kapasitas kelas');
    }


    foreach ($members as $member_id) {
        $exists = $this->bookingModel
            ->where('schedule_id', $schedule_id)
            ->where('member_id', $member_id)
            ->where('status', 'Booked')
            ->first();
            if ($exists) {
            continue; // skip, jangan insert dobel
        }
        $membership = $this->membershipModel->getActiveMembership($member_id);
            if (!$membership) {
            return redirect()->back()->with('error', 'Membership tidak aktif');
            }
        $this->bookingModel->insert([
            'schedule_id'   => $schedule_id,
            'member_id'    => $member_id,
            'booking_time' => date('Y-m-d H:i:s'),
            'status'       => 'Booked',
        ]);

    }

    return redirect()
        ->to('/schedule/detail/' . $schedule_id)
        ->with('success', 'Booking berhasil ditambahkan');
    }

    public function cancelBooking($booking_id)
{
    $booking = $this->bookingModel->find($booking_id);

    if (!$booking || ($booking['status']) !== 'Booked') {
        return redirect()->back()->with('error', 'Booking tidak bisa dibatalkan');
    }

    $this->bookingModel->update($booking_id, [
        'status' => 'Canceled'
    ]);

    return redirect()->back()->with('success', 'Booking berhasil dibatalkan');
}

      public function on_going($id)
    {
        $this->scheduleModel->update($id, [
            'status' => 'On going',
        ]);

        return redirect()->to('/schedule')->with('success', 'Data Schedule menjadi On going');
    }

    public function finish($id)
{
    // update schedule
    $this->scheduleModel->update($id, [
        'status' => 'Finish',
    ]);

    // update booking berdasarkan schedule
    $this->bookingModel
        ->where('schedule_id', $id)
        ->where('status', 'Booked')
        ->set(['status' => 'Attend'])
        ->update();

    return redirect()->back()
        ->with('success', 'Schedule finish & booking attend');
}

public function cancel($id)
{
    // cancel semua booking
    $this->bookingModel
        ->where('schedule_id', $id)
        ->where('status', 'Booked')
        ->set(['status' => 'Canceled'])
        ->update();

    // cancel schedule
    $this->scheduleModel->update($id, [
        'status' => 'Canceled'
    ]);

    return redirect()->to('/schedule')
        ->with('success', 'Schedule & booking berhasil dibatalkan');
}

public function cetak($id){
        $header = $this->scheduleModel->getHeaderById($id);

        $detail = $this->bookingModel->getbookingById($id);

        $data = [
            'header' => $header,
            'detail' => $detail,
        ];

        $html = view('schedule/pdf', $data);

        $pdf = new Pdf();
        $pdf->generate($html, 'Bukti Booking Kelas - ' . $id);
    }
}
