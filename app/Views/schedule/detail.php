<?= $this->extend('layout/main'); ?>
<?php
$full = $totalBooking >= $header['capacity'];
?>
<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Detail Schedule</h4>
   
    <a href="<?= base_url('schedule') ?>" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body p-3">
        <div class="card neon-info-card mb-4">
    <div class="card-body">
        <h3 class="neon-title">Informasi Jadwal</h3><br>
        <div class="row g-4">
            
            <div class="col-md-6 neon-divider">
                
                <p class="neon-text">
                    <span>Kelas</span>
                    <strong><?= $header['class_name']; ?></strong>
                </p>
                <p class="neon-text">
                    <span>Trainer</span>
                    <strong><?= $header['name']; ?></strong>
                </p>
                <p class="neon-text">
                    <span>Tanggal</span>
                    <strong><?= $header['schedule_date']; ?></strong>
                </p>
            </div>

            <div class="col-md-6">
                
                <p class="neon-text">
                    <span>Waktu</span>
                    <strong><?= $header['start_time']; ?> - <?= $header['end_time']; ?></strong>
                </p>
                <p class="neon-text">
                    <span>Status</span>
                    <strong><?= $header['status']; ?> </strong>
                </p>
                <p class="neon-text">
                    <span>Kapasitas</span>
                     <strong class="<?= $full ? 'text-danger' : 'text-success' ?>">
                        <?= $totalBooking; ?> / <?= $header['capacity']; ?>
                    </strong>
                </p>
            </div>
        </div>
    </div>
</div>
          

            <hr>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0 form-label-custom">Daftar Member yang booking</h5>
            <div class="text-end">
    <?php if ($header['status'] == 'Upcoming') : ?>
    <a href="<?= base_url('schedule/booking/'.$header['schedule_id']); ?>" class="btn btn-sm btn-warning" style="background-color:#6d28d9;">
      <i class="bi bi-plus-circle me-1"></i> Tambah Booking
    </a>
    <?php endif; ?>
</div>
        </div>

            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Member</th>
                            <th>Waktu Booking</th>
                            <th>status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        <?php foreach($detail as $data) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $data['name']?></td>
                                <td><?= $data['booking_time']?></td>
                                <td><?= $data['status']?></td>
                                <td>
                                <?php if ($data['status'] == 'Booked'): ?>
                                <a href="<?= base_url('schedule/cancelBooking/'.$data['booking_id']) ?>"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Batalkan booking?')">
                                Cancel
                                </a>
                                <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
        
            <div class="mt-3 d-flex justify-content-start gap-2">
                 <?php if ($header['status'] == 'Upcoming') : ?>
                 <a href="<?= base_url('schedule/on_going/'.$header['schedule_id'])?>" class="btn btn-sm btn-warning" style="background-color:#6d28d9;" onclick="return confirm('Schedule on going?')">
                         On going
                    </a>                    
                 <?php endif; ?>

                 <?php if ($header['status'] == 'Upcoming') : ?>
                 <a href="<?= base_url('schedule/cancel/'.$header['schedule_id'])?>" class="btn btn-sm btn-warning" style="background-color:#6d28d9;" onclick="return confirm('Schedule & booking cancel?')">
                        Cancel
                    </a>                    
                 <?php endif; ?>
    
                 <?php if ($header['status'] == 'On going') : ?>
                <a href="<?= base_url('schedule/finish/'.$header['schedule_id'])?>" class="btn btn-primary btn-sm" onclick="return confirm('Schedule finish?')">
                        Finish
                    </a>
<?php endif; ?>

                    <a href="<?= base_url('schedule/cetak/'.$header['schedule_id'])?>" class="btn btn-secondary btn-sm" target="_blank">
                     Cetak
                     </a>
            </div>
    </div>
     
</div>


<?= $this->endSection(); ?>