<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $db = \Config\Database::connect();

        $memberModel     = new \App\Models\MemberModel();
        $membershipModel = new \App\Models\MembershipModel();
        $trainersModel   = new \App\Models\TrainersModel();

        // ===== STATISTIK UTAMA =====
        $totalMembers    = $memberModel->countAllResults();
        $totalMembership = $membershipModel->countAllResults();
        $totalTrainers   = $trainersModel->countAllResults();
        
        // 👇 TAMBAHKAN INI UNTUK TOTAL KELAS
        $totalKelas = $db->table('classes')->countAllResults();

        $jadwalSelesai = $db->table('schedule')->where('status', 'Finish')->countAllResults();
        $jadwalBerjalan = $db->table('schedule')->where('status', 'Ongoing')->countAllResults();
        $jadwalBatal = $db->table('schedule')->where('status', 'Canceled')->countAllResults();

        // =====================================================
        // ===== MEMBER TERBARU (GANTI MEMBER PALING AKTIF) =====
        // =====================================================
        $latestMembers = $memberModel
            ->orderBy('join_date', 'DESC')
            ->limit(5)
            ->findAll();

        $memberTerbaru = [];

        foreach ($latestMembers as $member) {
            $nameParts = explode(' ', $member['name']);
            $avatar = strtoupper(substr($nameParts[0], 0, 1));
            if (isset($nameParts[1])) {
                $avatar .= strtoupper(substr($nameParts[1], 0, 1));
            }

            $latestMembership = $membershipModel
                ->select('type')
                ->where('member_id', $member['member_id'])
                ->orderBy('start_date', 'DESC')
                ->first();

            $memberTerbaru[] = [
                'name'       => $member['name'],
                'phone'      => $member['phone'],
                'avatar'     => $avatar,
                'membership' => $latestMembership['type'] ?? 'Regular',
                'join_date'  => $member['join_date'],
            ];
        }

        // ===== TRAINER PALING AKTIF NGAJAR =====
        $trainersStats = $db->table('schedule s')
            ->select('t.name AS trainer_name, COUNT(*) AS total_schedule')
            ->join('trainers t', 't.trainer_id = s.trainer_id')
            ->groupBy('s.trainer_id')
            ->orderBy('total_schedule', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        $trainersLabels = array_column($trainersStats, 'trainer_name');
        $trainersData   = array_column($trainersStats, 'total_schedule');

        // ===== MEMBER SERING BERLANGGANAN =====
        $memberSubscriptions = $db->table('membership m')
            ->select('mb.name AS member_name, COUNT(*) AS total_subscription')
            ->join('members mb', 'mb.member_id = m.member_id')
            ->groupBy('m.member_id')
            ->orderBy('total_subscription', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        $memberLabels = array_column($memberSubscriptions, 'member_name');
        $memberData   = array_column($memberSubscriptions, 'total_subscription');

        // ===== KELAS PALING DIMINATI =====
        $classStats = $db->table('schedule s')
            ->select('c.class_name, COUNT(*) AS total_schedule')
            ->join('classes c', 'c.class_id = s.class_id')
            ->groupBy('s.class_id')
            ->orderBy('total_schedule', 'DESC')
            ->get()
            ->getResultArray();

        $classLabels = array_column($classStats, 'class_name');
        $classData   = array_column($classStats, 'total_schedule');

        // ===== JADWAL BULAN INI =====
        $selectedMonth = $this->request->getGet('month') ?? date('Y-m');

        $finishedThisMonth = $db->table('schedule')->where('status', 'Finish')->like('schedule_date', $selectedMonth)->countAllResults();
        $ongoingThisMonth  = $db->table('schedule')->where('status', 'Ongoing')->like('schedule_date', $selectedMonth)->countAllResults();
        $canceledThisMonth = $db->table('schedule')->where('status', 'Canceled')->like('schedule_date', $selectedMonth)->countAllResults();

        return view('dashboard', [
            'title' => 'Dashboard',
            'subtitle' => 'Dashboard',
            'totalMembers' => $totalMembers,
            'totalMembership' => $totalMembership,
            'totalTrainers' => $totalTrainers,
            'totalKelas' => $totalKelas, 
            'jadwalSelesai' => $jadwalSelesai,
            'jadwalBerjalan' => $jadwalBerjalan,
            'jadwalBatal' => $jadwalBatal,
            'memberTerbaru' => $memberTerbaru,

            'trainersLabels' => $trainersLabels,
            'trainersData' => $trainersData,
            'memberLabels' => $memberLabels,
            'memberData' => $memberData,
            'classLabels' => $classLabels,
            'classData' => $classData,
            'finishedThisMonth' => $finishedThisMonth,
            'ongoingThisMonth' => $ongoingThisMonth,
            'canceledThisMonth' => $canceledThisMonth,
            'selectedMonth' => $selectedMonth,
            'totalThisMonth' => $finishedThisMonth + $ongoingThisMonth + $canceledThisMonth,
        ]);
    }
}