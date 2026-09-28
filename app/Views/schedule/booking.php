
<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Tambah Booking</h4>
    <a href="<?= base_url('schedule/detail/'.$header['schedule_id']); ?>" 
   class="btn btn-secondary btn-sm"> <i class="bi bi-arrow-left"></i>
   Kembali
</a>
</div>

<div class="card">
     <div class="mb-3 d-flex justify-content-between align-items-center">
                <label class="form-label-custom">Nama Member</label>
                <button type="button"  class="btn btn-sm btn-warning" style="background-color:#0d6efd;" id="btnTambahBaris">
                <i class="bi bi-plus-circle"></i> Tambah Member
                </button>
    </div>
  
        <form action="<?= base_url('schedule/bookinginsert/'.$header['schedule_id']); ?>" method="post">
            <?= csrf_field() ?>
            <!-- Tanggal Dan Nama Anggota -->
            

             <!-- Nama Member -->
                 <div id="wrapper-member">
            <div class="row mb-3 baris-member">
                <div class="col-md-6">
                    <select name="member_id[]" class="form-select member-select" required>
                        <option value=""> - Pilih Nama Member - </option>
                        <?php foreach ($member as $data) : ?>
                            <option value="<?= $data['member_id'] ?>">
                                <?= esc($data['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <button type="button" class="btn btn-neon-delete btnHapusBaris">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
                
            <!-- Tombol simpan dan reset -->
           <div class="d-flex gap-2 mt-3">
            <button type="submit" class="btn btn-sm btn-warning" style="background-color:#6d28d9;">
                <i class="bi bi-save"></i> Simpan Data
            </button>
            <button type="reset" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Reset
            </button>
        </div>
        </form>

        <script>

            const maxSlot = <?= $sisa ?>;
            document.getElementById('btnTambahBaris').addEventListener('click', function(){
                const wrapper = document.getElementById('wrapper-member');

                if (wrapper.querySelectorAll('.baris-member').length >= maxSlot) {
                    alert('Kapasitas kelas hampir penuh');
                    return;
                }

                const first = wrapper.querySelector('.baris-member');
                const clone = first.cloneNode(true);

                clone.querySelector('select').selectedIndex = 0;
                wrapper.appendChild(clone);

                addRemoveHandler(clone.querySelector('.btnHapusBaris'));
            });

            function addRemoveHandler(btn){
                btn.addEventListener('click', function(){
                    const row = this.closest('.baris-member');
                    const wrapper = document.getElementById('wrapper-member');

                    if(wrapper.querySelectorAll('.baris-member').length > 1){
                        row.remove();
                    }
                });
            }

            addRemoveHandler(document.querySelector('.btnHapusBaris'));
        </script>
    </div>     
</div>
<?= $this->endSection(); ?>