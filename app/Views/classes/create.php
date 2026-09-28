<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Tambah Member</h4>
    <a href="<?= base_url('classes') ?>" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body p-3">
        <form action="<?= base_url('classes/insert') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

             <!--class name-->
        <div class="mb-3">
            <label class="form-label-custom">Nama Kelas</label>
            <input type="text" name="class_name" class="form-control" placeholder="Contoh: Yoga" required>
        </div>

        <!--description-->
        <div class="mb-3">
            <label class="form-label-custom">Deskripsi</label>
            <input type="text" name="description" class="form-control" placeholder="Deksripsi singkat kelas" required>
        </div>

         <!--Capacity-->
        <div class="mb-3">
            <label class="form-label-custom">Kapasitas</label>
            <input type="Number" name="capacity" class="form-control"  required>
        </div>

        
        <div class="mb-3">
    <label class="form-label-custom">is active</label>
    <select name="is_active" class="form-select" required>
        <option value="0" selected>No</option>
        <option value="1">Yes</option>
    </select>
</div>

<!-- Cover -->
                  <div class="mb-3">
                    <label class="form-label-custom">Cover</label>
                    <input type="file" name="cover" class="form-control">
                    <small class="text-muted">Boleh Dikosongkan jika tidak ada gambar cover.</small>
                    </div>
 
        <!--Tombol simpan dan reset-->
        <div class="d-flex gap-2 mt-3">
        <button type="submit" class="btn btn-sm btn-warning" style="background-color:#6d28d9;">
            <i class="bi bi-save"></i> Simpan Data
        </button>
        <button type="reset" class="btn btn-secondary">
            <i class="bi bi-x-circle"></i> Reset
        </button>
        </div>
         </form>
    </div>
</div>

<?= $this->endSection(); ?>