<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Tambah Membership</h4>
    <a href="<?= base_url('membership') ?>" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body p-3">
        <form action="<?= base_url('membership/insert') ?>" method="post">
            <?= csrf_field() ?>

               <!-- Nama -->
                  <div class="mb-3">
                    <label class="form-label-custom">Nama Member</label>
                    <select name="member_id" class="form-select" required>
                        <option value=""> - Pilih Nama Member -</option>
                        <?php foreach($members as $data) : ?>
                            <option value="<?=$data['member_id'] ?>">
                                <?= $data['name']; ?>
                            </option>
                            <?php endforeach; ?>
                    </select>
                </div>

                
    <!--type-->
                 <div class="mb-3">
                    <label class="form-label-custom">Tipe</label>
                        <select name="type" id="type" class="form-select">
                        <option value="bronze">Bronze</option>
                        <option value="silver">Silver</option>
                        <option value="gold">Gold</option>
                    </select>
                </div>

     <!-- tgl mulai -->
                <div class="mb-3">
                        <label class="form-label-custom">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                 </div>

      <!-- tgl selesai -->
                <div class="mb-3">
                        <label class="form-label-custom">Tanggal selesai</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="<?= date('Y-m-d') ?>" readonly>
                 </div>           



         <!--harga-->
        <div class="mb-3">
            <label class="form-label-custom">Harga</label>
            <input type="text" name="price" id="price" class="form-control" readonly>
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

 <script>
document.addEventListener('DOMContentLoaded', function () {

    const typeSelect = document.getElementById('type');
    const startInput = document.getElementById('start_date');
    const endInput   = document.getElementById('end_date');
    const priceInput = document.getElementById('price');

    function calculateMembership() {
        if (!startInput.value) return;

        const type = typeSelect.value;
        const startDate = new Date(startInput.value);

        let price = 0;
        let duration = 0;

        if (type === 'bronze') {
            price = 150000;
            duration = 30;
        } else if (type === 'silver') {
            price = 200000;
            duration = 60;
        } else if (type === 'gold') {
            price = 300000;
            duration = 90;
        }

        startDate.setDate(startDate.getDate() + duration);
        endInput.value = startDate.toISOString().split('T')[0];
        priceInput.value = price;
    }

    // trigger dari dua input
    typeSelect.addEventListener('change', calculateMembership);
    startInput.addEventListener('change', calculateMembership);

    // optional: hitung pertama kali saat halaman dibuka
    calculateMembership();

});
</script>

<?= $this->endSection(); ?>