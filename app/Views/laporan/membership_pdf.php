<?php
$chunks = array_chunk($laporan, 15); 
$no = 1;

$totalPendapatan = 0;
foreach ($laporan as $row) {
    $totalPendapatan += $row['price'];
}
?>
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Membership</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            font-size: 12px;
            background: #f5f5f5;
            margin: 0;
        }

        .report {
            max-width: 800px; /* Lebar optimal A4 Portrait */
            margin: 20px auto;
            background: #fff;
            padding: 30px;
            border: 1px solid #333;
            box-shadow: 0 4px 8px rgba(0,0,0,.1);
            position: relative;
        }

        .header {
            text-align: center;
            border-bottom: 3px double #333;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h2 { margin: 0; font-size: 22px; letter-spacing: 1px; }
        .header h4 { margin-top: 5px; font-size: 14px; color: #555; font-weight: normal; }

        .info { margin-bottom: 15px; font-size: 12px; }
        .info strong { display: inline-block; width: 100px; }

        table {
            border-collapse: collapse;
            width: 100%;
            table-layout: fixed; /* Mengunci lebar kolom agar tidak berantakan */
        }

        th, td {
            border: 1px solid #333;
            padding: 8px 5px;
            font-size: 10.5px;
            word-wrap: break-word; /* Memastikan teks panjang turun ke bawah */
        }

        th {
            background: #333;
            color: #fff;
            text-align: center;
            text-transform: uppercase;
        }

        td.center { text-align: center; }
        td.right { text-align: right; }

        .section-title {
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 14px;
            border-left: 4px solid #333;
            padding-left: 10px;
        }

        .summary {
            margin-top: 20px;
            padding: 15px;
            background: #f9f9f9;
            border: 1px solid #333;
            display: inline-block;
            min-width: 250px;
        }

        .footer {
            margin-top: 30px;
            font-size: 10px;
            text-align: right;
            color: #777;
        }

        @page {
            size: A4 portrait;
            margin: 10mm;
        }

        @media print {
            body { background: #fff; }
            .report { 
                margin: 0; 
                border: none; 
                box-shadow: none; 
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

<?php foreach ($chunks as $pageIndex => $rows): ?>
<div class="report">

    <div class="header">
        <h2>FITCOURSE</h2>
        <h4>
            Laporan Transaksi Membership<br>
            Periode <?= date('F', mktime(0,0,0,$bulan,1)) ?> <?= $tahun ?>
        </h4>
    </div>

    <div class="info">
        <div><strong>Periode</strong>: <?= date('F Y', mktime(0,0,0,$bulan,1,$tahun)) ?></div>
        <div><strong>Dicetak Oleh</strong>: Sistem</div>
    </div>

    <div class="section-title">Data Membership</div>

    <table>
        <thead>
            <tr>
                <th style="width: 40px;">No</th>
                <th style="width: 150px;">Member</th>
                <th>Tipe</th>
                <th style="width: 80px;">Mulai</th>
                <th style="width: 80px;">Selesai</th>
                <th style="width: 100px;">Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <td class="center"><?= $no++; ?></td>
                    <td><?= $row['member_name']; ?></td>
                    <td class="center"><?= $row['type']; ?></td>
                    <td class="center"><?= date('d/m/y', strtotime($row['start_date'])); ?></td>
                    <td class="center"><?= date('d/m/y', strtotime($row['end_date'])); ?></td>
                    <td class="right">Rp <?= number_format($row['price'], 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if ($pageIndex === count($chunks) - 1): ?>
        <div class="summary">
            <strong>Ringkasan Laporan:</strong><br>
            Total Transaksi: <?= count($laporan); ?> Member<br>
            Total Pendapatan: <strong>Rp <?= number_format($totalPendapatan, 0, ',', '.'); ?></strong>
        </div>
    <?php endif; ?>

    <div class="footer">
        Halaman <?= $pageIndex + 1 ?> dari <?= count($chunks) ?> | Dicetak: <?= date('d-m-Y H:i'); ?>
    </div>

</div>

<?php if ($pageIndex < count($chunks) - 1): ?>
    <div style="page-break-after: always;"></div>
<?php endif; ?>

<?php endforeach; ?>

</body>
</html>