<?php
$chunks = array_chunk($laporan, 15); // 15 baris per halaman
$no = 1;

$totalCapacity = 0;
$totalBooking  = 0;
foreach ($laporan as $row) {
    $totalCapacity += $row['capacity'];
    $totalBooking  += $row['total_booking'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Schedule Kelas</title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            font-size: 13px;
            background: #f5f5f5;
        }

        .report {
            max-width: 900px;
            margin: 30px auto;
            background: #fff;
            padding: 35px;
            border: 2px solid #333;
            box-shadow: 0 4px 8px rgba(0,0,0,.1);
        }

        .header {
            text-align: center;
            border-bottom: 3px double #333;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
            letter-spacing: 1px;
        }

        .header h4 {
            margin-top: 6px;
            font-size: 15px;
            color: #555;
            font-weight: normal;
        }

        .info {
            margin-bottom: 20px;
            font-size: 13px;
        }

        .info strong {
            display: inline-block;
            width: 140px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
            table-layout: fixed;
        }

        th, td {
            border: 1px solid #333;
            padding: 6px;
            font-size: 10.5px;
            white-space: nowrap;
        }

        td {
            overflow: hidden;
            text-overflow: ellipsis;
        }

        th {
            background: #333;
            color: #fff;
            text-align: center;
            font-weight: 600;
        }

        tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        td.center {
            text-align: center;
        }

        .section-title {
            margin-top: 30px;
            font-weight: bold;
            font-size: 15px;
            border-left: 4px solid #333;
            padding-left: 10px;
        }

        .summary {
            margin-top: 20px;
            padding: 15px;
            background: #f5f5f5;
            border: 1px solid #ccc;
            font-size: 13px;
        }

        .footer {
            margin-top: 40px;
            font-size: 12px;
            text-align: right;
            color: #555;
        }

        @page {
            size: A4;
            margin: 15mm;
        }

        @media print {
            body {
                background: #fff;
            }
            .report {
                border: none;
                box-shadow: none;
                padding: 20px;
                margin: 0;
            }
        }
    </style>
</head>
<body>

<?php foreach ($chunks as $pageIndex => $rows): ?>
<div class="report">

    <!-- HEADER -->
    <div class="header">
        <h2>FITCOURSE</h2>
        <h4>
            Laporan Schedule Kelas<br>
            Periode <?= date('F', mktime(0,0,0,$bulan,1)) ?> <?= $tahun ?>
        </h4>
    </div>

    <!-- INFO -->
    <div class="info">
        <strong>Periode</strong>:
        Bulan <?= date('F', mktime(0,0,0,$bulan,1)) ?> Tahun <?= $tahun ?>
        <div><strong>Dicetak Oleh</strong>: Sistem</div>
    </div>

    <div class="section-title">Data Schedule Kelas</div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kelas</th>
                <th>Trainer</th>
                <th>Kapasitas</th>
                <th>Booking</th>
                <th>Utilisasi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
                <?php
                    $utilisasi = $row['capacity'] > 0
                        ? round(($row['total_booking'] / $row['capacity']) * 100)
                        : 0;
                ?>
                <tr>
                    <td class="center"><?= $no++; ?></td>
                    <td><?= $row['schedule_date']; ?></td>
                    <td><?= $row['class_name']; ?></td>
                    <td><?= $row['name']; ?></td>
                    <td class="center"><?= $row['capacity']; ?></td>
                    <td class="center"><?= $row['total_booking']; ?></td>
                    <td class="center"><?= $utilisasi; ?>%</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- SUMMARY HANYA DI HALAMAN TERAKHIR -->
    <?php if ($pageIndex === count($chunks) - 1): ?>
        <div class="summary">
            <div>Total Kapasitas: <strong><?= $totalCapacity; ?></strong></div>
            <div>Total Booking: <strong><?= $totalBooking; ?></strong></div>
        </div>
    <?php endif; ?>

    <div class="footer">
        Dicetak pada: <?= date('d-m-Y H:i'); ?>
    </div>

</div>

<?php if ($pageIndex < count($chunks) - 1): ?>
    <div style="page-break-after: always;"></div>
<?php endif; ?>

<?php endforeach; ?>

</body>
</html>