<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>



    

    <div class="card mb-3">
        <div class="card-body">
            <form action="<?= base_url('laporan/schedule') ?>" method="get" class="row g-3">

                <div class="col-md-3">
                    <label class="form-label">Bulan</label>
                    <select name="bulan" class="form-select">
                        <?php for($i=1;$i<=12;$i++): ?>
                            <option value="<?= $i ?>" <?= ($bulan == $i ? 'selected' : '') ?>>
                                <?= date('F', mktime(0,0,0,$i,1)) ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Tahun</label>
                    <select name="tahun" class="form-select">
                        <?php for($t = $tahunMulai; $t <= date('Y'); $t++): ?>
                            <option value="<?= $t ?>" <?= ($tahun == $t ? 'selected' : '') ?>>
                                <?= $t ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit"  class="btn btn-sm btn-warning" style="background-color:#6d28d9;" >Tampilkan</button>
                </div>

            </form>
        </div>
    </div>

<!-- tabel laporan -->
 <div class="card">
    <div class="card-body p-3">
        <div class="table-responsive">
            <table class="table table-bordered table-sm mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width:40px;">No</th>
                        <th>Tanggal</th>
                        <th>Kelas</th>
                        <th>Trainer</th>
                        <th class="text-center">Kapasitas</th>
                        <th class="text-center">Booking</th>
                        <th class="text-center">Sisa</th>
                        <th class="text-center">Utilisasi</th>
                    </tr>

                    </thead>
                    <tbody>
                        <?php if(empty($laporan)):?>
                            <tr>
                                <td colspan="8" class="text-center text-muted">Tidak ada data schedule pada periode ini.</td>
                            </tr>
                        <?php else :?>

                        <?php
                            $no = 1;
                            $totalSchedule = 0;
                            $totalCapacity = 0;
                            $totalBooking  = 0;
                        ?>

                        <?php foreach($laporan as $data):?>
                            <?php
                                $totalSchedule++;
                                $totalCapacity += (int) $data['capacity'];
                                $totalBooking  += (int) $data['total_booking'];

                                $sisa = $data['capacity'] - $data['total_booking'];

                                $utilisasi = ($data['capacity'] > 0)
                                    ? round(($data['total_booking'] / $data['capacity']) * 100)
                                    : 0;
                                $kelas = $utilisasi < 40 ? 'text-danger' : ($utilisasi <= 70 ? 'text-warning' : 'text-success');
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data['schedule_date']?></td>
                                    <td><?= $data['class_name']?></td>
                                    <td><?= $data['name']?></td>
                                    <td class="text-center"><?= $data['capacity']?></td>
                                    <td class="text-center"><?= $data['total_booking']?></td>
                                    <td class="text-center"><?= $sisa?></td>
                                    <td class="text-center fw-bold <?= $kelas ?>"><?= $utilisasi ?>%</td>
                                </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    <?php if(!empty($laporan)):?>
                       <tfoot class="table-primary">
                            <tr>
                                <td colspan="3"><strong>Ringkasan</strong></td>
                                <td><?= $totalSchedule; ?> Jadwal</td>
                                <td class="text-center"><?= $totalCapacity; ?></td>
                                <td class="text-center"><?= $totalBooking; ?></td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>
                    <?php endif; ?>
                    </table>
                    <a href="<?= base_url('laporan/schedule/pdf?bulan='.$bulan.'&tahun='.$tahun) ?>"
                        class="btn btn-outline-dark btn-sm mt-3">
                            <i class="bi bi-file-earmark-pdf-fill"></i> Download PDF
                    </a>
            </div>
        </div>
 </div>


<?= $this->endSection(); ?>