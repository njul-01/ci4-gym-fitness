<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Tambah Trainer</h4>
    <a href="<?= base_url('trainers') ?>" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body p-3">
        <form action="<?= base_url('trainers/insert') ?>" method="post">
            <?= csrf_field() ?>

             <!--nama trainer-->
        <div class="mb-3">
            <label class="form-label-custom">Nama Trainer</label>
            <input type="text" name="name" class="form-control" placeholder="Masukan nama trainer" required>
        </div>

        <!--phone-->
        <div class="mb-3">
            <label class="form-label-custom">No Hp</label>
            <input type="text" name="phone" class="form-control" maxlength="13"
        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 13)" placeholder="08123..." required>
        </div>

         <!--Email-->
        <div class="mb-3">
            <label class="form-label-custom">Email</label>
            <input type="text" name="email" class="form-control" placeholder="trainer@gmail.com" required>
        </div>

         <!--Email-->
<<<<<<< HEAD
        <!-- Spesialis -->
<div class="mb-3">
    <label class="form-label-custom">Spesialis</label>

    <div class="row">
        <?php foreach ($classes as $c): ?>
            <div class="col-3">
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="speciality[]"
                        value="<?= $c['class_name']; ?>"
                    >
                    <label class="form-check-label">
                        <?= $c['class_name']; ?>
                    </label>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>



=======
        <div class="mb-3">
            <label class="form-label-custom">Spesialis</label>
            <input type="text" name="speciality" class="form-control" placeholder="Yoga,HIIT,Cardio" required>
        </div>
>>>>>>> parent of e55568e (update members model & membership controller)
        
        

 
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