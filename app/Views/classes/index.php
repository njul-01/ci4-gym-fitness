<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<?php 
$currentPage = $pager->getCurrentPage('classes');
$perPage = $perPage ?? 10; 
$noAwal = 1 + ($perPage * ($currentPage - 1));
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"></h4>

    <!-- Form Pencarian -->
    <div class="d-flex gap-2">
        <form action="<?= base_url('classes') ?>" class="d-flex" method="get">
            <div class="input-group input-group-sm">
                <input type="text" name="keyword" class="form-control" placeholder="Cari kelas..." value="<?= esc($keyword ?? '') ?>">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
        <a href="<?= base_url('classes/create') ?>" class="btn btn-sm btn-warning" style=" background-color:#6d28d9;">
            <i class="bi bi-plus-circle me-1"></i> Tambah Kelas
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
                        <th>Deskripsi</th>
                        <th class="text-center">Capacity</th>
                        <th class="text-center">is active</th>
                        <th class="text-center">Cover</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($classes)) : ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                <?php if(!empty($keyword)): ?>
                                    Tidak ada data kelas dengan kata kunci "<?= esc($keyword) ?>"
                                <?php else: ?>
                                    Belum ada data Kelas
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $no = $noAwal; ?>
                        <?php foreach($classes as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($row['class_name']); ?></td>
                                <td class="desc-column"><?= esc($row['description']); ?></td>
                                <td class="text-center"><?= esc($row['capacity']); ?></td>
                                <td class="text-center">
                                    
                                    <?php if($row['is_active'] == 1): ?>
                                        <a href="<?= base_url('classes/no/'.$row['class_id']) ?>"
                                class="badge bg-primary"
                                onclick="return confirm('non aktifkan class?')">
                                Yes
                                </a>
                                    <?php else: ?>
                                       <a href="<?= base_url('classes/yes/'.$row['class_id']) ?>"
                                class="badge bg-secondary"
                                onclick="return confirm('aktifkan class?')">
                                No
                                </a>
                                    <?php endif; ?>
                                </td>

                                <td class="text-center">
                                    <?php if(!empty($row['cover'])): ?>
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalCover<?= $row['class_id'] ?>">
                                            <i class="bi bi-eye"></i> Lihat
                                        </button>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif ?>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="<?= base_url('classes/edit/' . $row['class_id']) ?>" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination di sini -->
        <?php if(!empty($classes)): ?>
            <div class="mt-3">
                <?= $pager->links('classes', 'bootstrap'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal untuk cover - diletakkan di luar card -->
<?php if(!empty($classes)): ?>
    <?php foreach($classes as $row): ?>
        <?php if(!empty($row['cover'])): ?>
            <div class="modal fade" id="modalCover<?= $row['class_id'] ?>" tabindex="-1" aria-labelledby="modalCoverLabel<?= $row['class_id'] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCoverLabel<?= $row['class_id'] ?>">
                                Cover: <?= esc($row['class_name']); ?>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="<?= base_url('image/cover/'. $row['cover']) ?>" alt="Cover <?= esc($row['class_name']) ?>" class="img-fluid rounded">
                        </div>          
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
    <?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection(); ?>