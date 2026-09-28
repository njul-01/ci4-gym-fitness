<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Ubah Trainer</h4>
    <a href="<?= base_url('trainers') ?>" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body p-3">
        <form action="<?= base_url('trainers/update/'. $trainers['trainer_id']) ?>" method="post">
            <?= csrf_field() ?>

                    <!--Nama-->
        <div class="mb-3">
            <label class="form-label-custom">Nama Trainer</label>
            <input type="text" name="name" class="form-control" value="<?= $trainers['name'] ?>" required>
        </div>


        <!--No hp-->
        <div class="mb-3">
            <label class="form-label-custom">No HP</label>
            <input type="text" name="phone" class="form-control" value="<?= $trainers['phone'] ?>" maxlength="13"
    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 13)" required>
        </div>


        <!--Email-->
        <div class="mb-3">
            <label class="form-label-custom">Email</label>
            <input type="text" name="email" class="form-control" value="<?= $trainers['email'] ?>" required>
        </div>

        
      
        <!-- Spesialis -->
        <div class="mb-3">
            <label class="form-label-custom">Spesialis</label>

            <?php
            
            $trainerSpesialis = $trainers['speciality']
                ? explode(', ', $trainers['speciality'])
                : [];
            ?>

            <div class="row">
                <?php foreach ($classes as $c): ?>
                    <div class="col-3">
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="speciality[]"
                                value="<?= $c['class_name']; ?>"
                                <?= in_array($c['class_name'], $trainerSpesialis) ? 'checked' : '' ?>
                            >
                            <label class="form-check-label">
                                <?= $c['class_name']; ?>
                            </label>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

       <!-- Tombol Inactive / Active -->
        <div class="text-center mt-2">
            <?php if ($trainers['status'] == 'Active') : ?>
                <a href="<?= base_url('trainers/inactive/'.$trainers['trainer_id'])?>"
                class="btn btn-sm btn-success"
                onclick="return confirm('Inactivekan Trainer?')">
                    Inactive
                </a>
            <?php else : ?>
                <a href="<?= base_url('trainers/active/'.$trainers['trainer_id'])?>"
                class="btn btn-sm btn-success"
                onclick="return confirm('Activekan Trainer?')">
                    Active
                </a>
            <?php endif; ?>
        </div>

        <!-- Tombol Simpan & Reset -->
        <div class="form-actions d-flex justify-content-center gap-2 mt-2">
            <button type="submit" class="btn btn-sm btn-warning" style="background-color:#6d28d9;">
                <i class="bi bi-save"></i> Simpan Data
            </button>
            <button type="reset" class="btn btn-secondary btn-sm">
                <i class="bi bi-x-circle"></i> Reset
            </button>
        </div>

         </form>
    </div>
</div>

<?= $this->endSection(); ?>