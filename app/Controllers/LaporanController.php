<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use App\Models\MembershipModel;
use App\models\ScheduleModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LaporanController extends BaseController
{
    protected $scheduleModel;
    protected $membershipModel;
    public function __construct(){
        $this->scheduleModel = new ScheduleModel();
        $this->membershipModel = new MembershipModel();
    }

    public function schedule()
    {
        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');
        if (!$bulan || !$tahun) {
    return redirect()->back()->with('error', 'Periode tidak valid');
}
        $tahunAwal = $this->scheduleModel
            ->selectMin('schedule_date')
            ->first();

        $tahunMulai = date('Y', strtotime($tahunAwal['schedule_date']));

        $laporan = $this->scheduleModel->getLaporanScheduleBulanan($bulan, $tahun);

        $data = [
            'title' => 'Laporan',
            'subtitle' => 'Laporan Schedule',
            'laporan' => $laporan,
            'bulan'   => (int) $bulan,
            'tahun'   => (int) $tahun,
            'tahunMulai' => $tahunMulai,
            'tahunAwal' => $tahunAwal,
        ];

        return view('laporan/schedule', $data);
    }

   public function schedulePdf()
{
    $bulan = $this->request->getGet('bulan');
    $tahun = $this->request->getGet('tahun');

    if (!$bulan || !$tahun) {
        return redirect()->back()->with('error', 'Periode tidak valid');
    }

    $laporan = $this->scheduleModel
        ->getLaporanScheduleBulanan($bulan, $tahun);

    $data = [
        'bulan'   => $bulan,
        'tahun'   => $tahun,
        'laporan' => $laporan
    ];

    $html = view('laporan/schedule_pdf', $data);

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    return $this->response
        ->setHeader('Content-Type', 'application/pdf')
        ->setHeader(
            'Content-Disposition',
            'attachment; filename=laporan_schedule_'.$bulan.'_'.$tahun.'.pdf'
        )
        ->setBody($dompdf->output());
}


    public function membership()
{
    $bulan  = $this->request->getGet('bulan') ?? date('m');
    $tahun  = $this->request->getGet('tahun') ?? date('Y');
    if (!$bulan || !$tahun) {
    return redirect()->back()->with('error', 'Periode tidak valid');
}
    $status = $this->request->getGet('status');

    $laporan = $this->membershipModel
        ->getLaporanMembershipBulanan($bulan, $tahun, $status);

    return view('laporan/membership', [
        'title'   => 'Laporan',
        'subtitle'=> 'Laporan Membership',
        'bulan'   => (int)$bulan,
        'tahun'   => (int)$tahun,
        'status'  => $status,
        'laporan' => $laporan
    ]);
}

public function membershipPdf()
{
    $bulan  = $this->request->getGet('bulan');
    $tahun  = $this->request->getGet('tahun');
    if (!$bulan || !$tahun) {
    return redirect()->back()->with('error', 'Periode tidak valid');
    }
    $status = $this->request->getGet('status');

    $data = [
        'bulan'   => $bulan,
        'tahun'   => $tahun,
        'laporan' => $this->membershipModel
            ->getLaporanMembershipBulanan($bulan, $tahun, $status)
    ];

    $html = view('laporan/membership_pdf', $data);

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    return $this->response
        ->setHeader('Content-Type', 'application/pdf')
        ->setHeader(
            'Content-Disposition',
            'attachment; filename=laporan_membership_'.$bulan.'_'.$tahun.'.pdf'
        )
        ->setBody($dompdf->output());
}
       
}
