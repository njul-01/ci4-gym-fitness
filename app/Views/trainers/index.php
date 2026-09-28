<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

    <?php
    $currentPage = $pager->getCurrentPage('trainers');
    $perPage = $perPage ?? 10;
    $noAwal = 1 + ($perPage * ($currentPage - 1));
    ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"></h4>
     <!-- Form Pencarian -->
    <div class="d-flex gap-2">
        <form action="<?= base_url('trainers') ?>" class="d-flex" method="get">
            <div class="input-group input-group-sm">
                <input type="text" name="keyword" class="form-control" placeholder="Cari trainer..." value="<?= esc($keyword ?? '') ?>">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    <a href="<?= base_url('trainers/create') ?>" class="btn btn-sm btn-warning" style="background-color:#6d28d9;">
        <i class="bi bi-plus-circle me-1"></i> Tambah Trainer
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
                        <th>Nama Trainer</th>
                        <th>No Hp</th>
                        <th>Email</th>
                        <th>Spesialitas</th>
                        <th class="text-center">Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = $noAwal; ?>
                    <?php foreach($trainers as $i => $row):?>
                        <tr>
                             <td><?= $no++ ?></td>
                             <td><?= esc($row['name']); ?></td>
                             <td><?= esc($row['phone']); ?></td>
                             <td><?= esc($row['email']); ?></td>
                             <td><?= esc($row['speciality']); ?></td>
                             <td class="text-center"><?= esc($row['status']); ?></td>
                             <td>
                                <div class="d-flex gap-2">
                                <a href="<?= base_url('trainers/edit/' . $row['trainer_id']) ?>" class="btn btn-sm btn-warning">
                                  <i class="bi bi-pencil"></i>  Edit
                                </a>
                    </div>
                             </td>
                        </tr>
                        <?php endforeach;?>

                        <?php if(empty($trainers)) : ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted">Belum ada data Trainer</td>
                            </tr>
                            <?php
                            endif;
                            ?>
                </tbody>
            </table>
            <div class="mt-3">
                <?= $pager->links('trainers', 'bootstrap'); ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>