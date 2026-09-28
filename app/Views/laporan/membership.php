<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>



<!-- FILTER -->
<div class="card mb-3">
    <div class="card-body">
        <form method="get" action="<?= base_url('laporan/membership') ?>" class="row g-3">

            <div class="col-md-3">
                <label class="form-label">Bulan</label>
                <select name="bulan" class="form-select">
                    <?php for($i=1;$i<=12;$i++): ?>
                        <option value="<?= $i ?>" <?= ($bulan == $i ? 'selected' : '') ?>>
                            <?= date('F', mktime(0,0,0,$i,1)) ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Tahun</label>
                <select name="tahun" class="form-select">
                    <?php for($t = date('Y')-5; $t <= date('Y')+1; $t++): ?>
                        <option value="<?= $t ?>" <?= ($tahun == $t ? 'selected' : '') ?>>
                            <?= $t ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Status Membership</label>
                <select name="status" class="form-select">
                    <option value="">Semua</option>
                    <option value="Active" <?= ($status=='Active'?'selected':'') ?>>Aktif</option>
                    <option value="Expired" <?= ($status=='Expired'?'selected':'') ?>>Expired</option>
                </select>
            </div>

            <div class="col-md-3 d-flex align-items-end">
                <button class="btn btn-primary w-100">
                    Tampilkan
                </button>
            </div>

        </form>
    </div>
</div>

<!-- TABEL LAPORAN -->
<div class="card">
    <div class="card-body p-3">
        <div class="table-responsive">

            <table class="table table-bordered table-sm mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="40">No</th>
                        <th>Kode Member</th>
                        <th>Nama Member</th>
                        <th>Tipe Membership</th>
                        <th>Mulai</th>
                        <th>Berakhir</th>
                        <th class="text-center">Status</th>
                        <th class="text-end">Harga</th>
                    </tr>
                </thead>

                <tbody>
                <?php if(empty($laporan)): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted">
                            Tidak ada data membership pada periode ini.
                        </td>
                    </tr>
                <?php else: ?>

                    <?php
                        $no = 1;
                        $totalMembership = 0;
                        $totalHarga = 0;
                    ?>

                    <?php foreach($laporan as $row): ?>
                        <?php
                            $totalMembership++;
                            $totalHarga += (int) $row['price'];
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['member_code']; ?></td>
                            <td><?= $row['member_name']; ?></td>
                            <td><?= $row['type']; ?></td>
                            <td><?= $row['start_date']; ?></td>
                            <td><?= $row['end_date']; ?></td>
                            <td class="text-center">
                                <span class="badge <?= $row['status']=='Active'?'bg-success':'bg-secondary' ?>">
                                    <?= $row['status']; ?>
                                </span>
                            </td>
                            <td class="text-end">
                                Rp <?= number_format($row['price'],0,',','.'); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                <?php endif; ?>
                </tbody>

                <?php if(!empty($laporan)): ?>
                <tfoot class="table-primary">
                    <tr>
                        <td colspan="3"><strong>Ringkasan</strong></td>
                        <td colspan="2"><?= $totalMembership; ?> Membership</td>
                        <td colspan="3" class="text-end">
                            <strong>Total:</strong>
                            Rp <?= number_format($totalHarga,0,',','.'); ?>
                        </td>
                    </tr>
                </tfoot>
                <?php endif; ?>

            </table>

            <!-- CETAK -->
            <a href="<?= base_url('laporan/membership/pdf?bulan='.$bulan.'&tahun='.$tahun.'&status='.$status) ?>"
            class="btn btn-danger btn-sm mt-3">
                <i class="bi bi-file-earmark-pdf-fill"></i>
                Download PDF
            </a>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
