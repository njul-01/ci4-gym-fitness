<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>
<?php 
$currentPage = $pager->getCurrentPage('membership');
$perPage = $perPage ?? 10; 
$noAwal = 1 + ($perPage * ($currentPage -1));
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"></h4>

    <!-- Form Pencarian -->
    <div class="d-flex gap-2">
        <form action="<?= base_url('membership') ?>" class="d-flex" method="get">
            <div class="input-group input-group-sm">
                <input type="text" name="keyword" class="form-control" placeholder="Cari membership..." value="<?= esc($keyword ?? '') ?>">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
        <a href="<?= base_url('membership/create') ?>"  class="btn btn-sm btn-warning" style="background-color:#6d28d9;">
            <i class="bi bi-plus-circle me-1"></i> Tambah Membership
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
                        <th>Nama Member</th>
                        <th>Tipe</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Selesai</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                     <?php $no = $noAwal; ?>
                    <?php foreach($membership as $i => $row):?>
                        <tr>
                             <td><?= $no++ ?></td>
                             <td><?= esc($row['name']); ?></td>
                             <td><?= esc($row['type']); ?></td>
                             <td><?= esc($row['start_date']); ?></td>
                             <td><?= esc($row['end_date']); ?></td>
                             <td><?= esc($row['price']); ?></td>
                             <td><?= esc($row['status']); ?></td>
                             <td>
                            <?php if ($row['status'] === 'Inactive'): ?>
                                <a href="<?= base_url('membership/edit/' . $row['membership_id']) ?>" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                            <?php else: ?>
                                <button class="btn btn-sm btn-secondary" disabled>
                                    <i class="bi bi-lock"></i> Locked
                                </button>
                            <?php endif; ?>
                             </td>
                        </tr>
                    <?php endforeach;?>

                    <?php if(empty($membership)) : ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada data Membership</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            
                <div class="mt-3">
                    <?= $pager->links('membership', 'bootstrap'); ?>
                </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>