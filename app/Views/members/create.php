<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Tambah Member</h4>
        <a href="<?= base_url('members') ?>" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
</div>

<div class="card">
    <div class="card-body p-3">
        <form action="<?= base_url('members/insert') ?>" method="post">
            <?= csrf_field() ?>
            <!--kode member-->
            <div class="mb-3">
                <label class="form-label-custom">Kode Member</label>
                <input type="text" name="member_code" class="form-control" placeholder="Contoh: M0001" required>
            </div>

            <!--nama member-->
            <div class="mb-3">
                <label class="form-label-custom">Nama Member</label>
                <input type="text" name="name" class="form-control" placeholder="Masukan nama lengkap" required>
            </div>

            <!--No Hp-->
            <div class="mb-3">
                <label class="form-label-custom">No Hp</label>
                <input type="text" name="phone" class="form-control" maxlength="13"
                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 13)" placeholder="08123..." required>
            </div>

            <!--Email-->
            <div class="mb-3">
                <label class="form-label-custom">Email</label>
                <input type="email" name="email" class="form-control" placeholder="member@gmail.com" required>
            </div>

            <!--No Hp-->
            <div class="mb-3">
                <label class="form-label-custom">Tgl Join</label>
                <input type="date" name="join_date" class="form-control" value="<?= date('Y-m-d') ?>" required>
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