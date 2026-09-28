<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>


<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Ubah Kelas</h4>
    <a href="<?= base_url('classes') ?>" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body p-3">
        <form action="<?= base_url('classes/update/'. $classes['class_id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

              <!--nama kelas-->
        <div class="mb-3">
            <label class="form-label-custom">Nama Kelas</label>
            <input type="text" name="class_name" class="form-control" value="<?= $classes['class_name'] ?>" required>
        </div>

        <!--Nama-->
        <div class="mb-3">
            <label class="form-label-custom">Deskripsi</label>
            <input type="text" name="description" class="form-control" value="<?= $classes['description'] ?>" required>
        </div>


        <!--capacity-->
        <div class="mb-3">
            <label class="form-label-custom">Kapasitas</label>
            <input type="number" name="capacity" class="form-control" value="<?= $classes['capacity'] ?>" required>
        </div>

     <!-- Cover -->
                  <div class="mb-3">
                    <label class="form-label-custom">Cover</label>
                    <?php if(!empty($classes['cover'])): ?>
                        <div class="mb-2">
                            <img src="<?= base_url('image/cover/'.$classes['cover']) ?>" alt="" style="max-height: 100px;" class="img-thumbnail">
                        </div>
                    <?php endif ?>
                    <input type="file" name="cover" class="form-control">
                    <small class="text-muted">kosongkan jika tidak ingin ganti gambar cover.</small>
                    </div>
                    <!-- Simpan nama cover lama jika tidak diganti -->
                     <input type="hidden" name="cover_lama" value="<?=$classes['cover'] ?>" >

        <!--Tombol simpan dan reset-->
        <div class="d-flex gap-2 mt-3">
        <button type="submit" class="btn btn-sm btn-warning" style="background-color:#6d28d9;">
            <i class="bi bi-save"></i> Simpan Data
        </button>
        <button type="reset" class="btn btn-secondary">
            <i class="bi bi-x-circle"></i> Reset
        </button>
    </div>
    </div>
</div>

<?= $this->endSection(); ?>