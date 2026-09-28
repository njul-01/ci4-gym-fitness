<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

    <?php
    $currentPage = $pager->getCurrentPage('schedules');
    $perPage = $perPage ?? 10;
    $noAwal = 1 + ($perPage * ($currentPage - 1));
    ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"></h4>
        <!-- Form Pencarian -->
    <div class="d-flex gap-2">
        <form action="<?= base_url('schedule') ?>" class="d-flex" method="get">
            <div class="input-group input-group-sm">
                <input type="text" name="keyword" class="form-control" placeholder="Cari schedule..." value="<?= esc($keyword ?? '') ?>">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    <a href="<?= base_url('schedule/create') ?>" class="btn btn-sm btn-warning" style="background-color:#6d28d9;">
        <i class="bi bi-plus-circle me-1"></i> Tambah Schedule
    </a>
</div>
</div>
<div class="card">
    <div class="card-body p-3">
        <div class="table-responsive">
            <table class="table table-hover table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Trainer</th>
                        <th>Tanggal</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = $noAwal; ?>
                    <?php foreach($schedules as $i => $row):?>
                        <tr>
                             <td><?= $no++ ?></td>
                             <td><?= esc($row['class_name']); ?></td>
                             <td><?= esc($row['name']); ?></td>
                             <td><?= esc($row['schedule_date']); ?></td>
                             <td><?= esc($row['start_time']); ?></td>
                             <td><?= esc($row['end_time']); ?></td>
                             <td><?= esc($row['status']); ?></td>
                             <td class="text-center">
                                <a href="<?= base_url('schedule/detail/'.$row['schedule_id'])?>"  class="btn btn-sm btn-warning" style="background-color:#6d28d9;">
                                    Detail
                                </a>
                            </div>
                             </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if(empty($schedules)) : ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada data Schedule</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="mt-3">
            <?= $pager->links('schedules', 'bootstrap') ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>