<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Create Schedule</h4>
    <a href="<?= base_url('schedule') ?>" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>
<div class="card">
    <div class="card-body p-3">
        <form action="<?= base_url('schedule/insert') ?>" method="post">
            <?= csrf_field() ?>

               <!-- Kelas -->
                <div class="mb-3">
                    <label class="form-label-custom">Kelas</label>
                    <select name="class_id" class="form-select" required>
                        <option value=""> - Pilih Kelas -</option>
                        <?php foreach($classes as $data) : ?>
                            <option value="<?=$data['class_id'] ?>">
                                <?= $data['class_name']; ?>
                            </option>
                            <?php endforeach; ?>
                    </select>
                </div>
                <!-- Trainer -->
                <div class="mb-3">
                    <label class="form-label-custom">Trainer</label>
                    <select name="trainer_id" id="trainer" class="form-select" required>
                        <option value=""> - Pilih Trainer -</option>
                    </select>
                </div>
            <!-- Tanggal -->
            <div class="mb-3">
                <label class="form-label-custom">Tanggal</label>
                <input type="date" name="schedule_date" class="form-control" value="<?= date('Y-m-d') ?>" required>
            </div>
            <!-- Waktu Mulai -->
            <div class="mb-3">
                <label class="form-label-custom">Waktu Mulai</label>
                <input type="time" name="start_time" class="form-control" required>
            </div>
            <!-- Waktu Selesai -->
            <div class="mb-3">
                <label class="form-label-custom">Waktu Selesai</label>
                <input type="time" name="end_time" class="form-control" required>
            </div>

            <!--Tombol simpan dan reset-->
            <div class="d-flex gap-2 mt-3">
            <button type="submit" class="btn btn-sm btn-warning" style="background-color:#6d28d9;">
                <i class="bi bi-save"></i> Simpan Data
            </button>
        </form>
    </div>
</div>

<script>
document.querySelector('select[name="class_id"]').addEventListener('change', function () {
    const classId = this.value;
    const trainerSelect = document.getElementById('trainer');

    trainerSelect.innerHTML = '<option value="">Loading...</option>';

    if (!classId) {
        trainerSelect.innerHTML = '<option value=""> - Pilih Trainer -</option>';
        return;
    }

    fetch(`<?= base_url('schedule/trainers-by-class') ?>/${classId}`)
        .then(response => response.json())
        .then(data => {
            trainerSelect.innerHTML = '<option value=""> - Pilih Trainer -</option>';

            if (data.length === 0) {
                trainerSelect.innerHTML += '<option value="">Tidak ada trainer sesuai</option>';
            }

            data.forEach(trainer => {
                trainerSelect.innerHTML += `
                    <option value="${trainer.trainer_id}">
                        ${trainer.name} - ${trainer.speciality}
                    </option>
                `;
            });
        });
});
</script>

<?= $this->endSection(); ?>