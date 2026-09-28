<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Ubah Member</h4>
        <a href="<?= base_url('members') ?>" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
</div>

<div class="card">
    <div class="card-body p-3">
        <form action="<?= base_url('members/update/'. $members['member_id']) ?>" method="post">
            <?= csrf_field() ?>

        <!--kode member-->
        <div class="mb-3">
            <label class="form-label-custom">Kode Member</label>
            <input type="text" name="member_code" class="form-control" value="<?= $members['member_code'] ?>" required>
        </div>

        <!--Nama-->
        <div class="mb-3">
            <label class="form-label-custom">Nama Member</label>
            <input type="text" name="name" class="form-control" value="<?= $members['name'] ?>" required>
        </div>


        <!--No hp-->
        <div class="mb-3">
            <label class="form-label-custom">No HP</label>
            <input type="text" name="phone" class="form-control" value="<?= $members['phone'] ?>" maxlength="13"
    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 13)" required>
        </div>


        <!--Email-->
        <div class="mb-3">
            <label class="form-label-custom">Email</label>
            <input type="text" name="email" class="form-control" value="<?= $members['email'] ?>" required>
        </div>

         <!--Join date-->
        <div class="mb-3">
            <label class="form-label-custom">Join Date</label>
            <input type="date" name="join_date" class="form-control" value="<?= $members['join_date'] ?>" required>
        </div>

        <!-- Status -->
        <div class="mt-3">
                 <?php if ($members['status'] == 'Active') : ?>
                 <a href="<?= base_url('members/inactive/'.$members['member_id'])?>" class="btn btn-sm btn-success" onclick="return confirm('Inactivekan Member?')">
                        Inactive
                </a>

                <?php elseif ($members['status'] == 'Inactive') : ?>
                 <a href="<?= base_url('members/active/'.$members['member_id'])?>" class="btn btn-sm btn-success" onclick="return confirm('Activekan Member?')">
                        Active
                </a>
                 <?php endif; ?>
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