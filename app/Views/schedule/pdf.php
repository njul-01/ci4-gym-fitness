<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Booking Jadwal Kelas</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            font-size: 13px;
            max-width: 850px;
            margin: 30px auto;
            padding: 30px;
            background: #fafafa;
        }

        .receipt {
            background: white;
            padding: 35px;
            border: 2px solid #333;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
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
            margin: 8px 0 0 0;
            font-size: 15px;
            color: #555;
            font-weight: normal;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
        }

        th, td {
            border: 1px solid #333;
            padding: 12px;
        }

        th {
            background: #333;
            color: white;
            font-weight: 600;
            text-align: left;
        }

        .info-table td:first-child {
            width: 200px;
            font-weight: 600;
            background: #f5f5f5;
        }

        .members-table tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        .members-table .no {
            text-align: center;
            width: 60px;
            font-weight: bold;
        }

        .members-table .time {
            width: 180px;
        }

        .members-table .status {
            width: 150px;
            text-align: center;
        }

        .section-title {
            font-size: 15px;
            font-weight: bold;
            margin: 30px 0 10px 0;
            padding-left: 10px;
            border-left: 4px solid #333333;
        }

        .signature {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #999;
            text-align: right;
            font-size: 13px;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px dashed #999;
            font-size: 11px;
            color: #666;
        }

        @media print {
            body {
                background: white;
                margin: 0;
                padding: 0;
            }
            .receipt {
                border: 1px solid #333;
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <h2>GYM & FITNESS</h2>
            <h4>Bukti Booking Jadwal Kelas</h4>
        </div>

        <table class="info-table">
            <tr>
                <td>Nama Kelas</td>
                <td><?= $header['class_name']; ?></td>
            </tr>
            <tr>
                <td>Nama Trainer</td>
                <td><?= $header['name']; ?></td>
            </tr>
            <tr>
                <td>Tanggal Jadwal</td>
                <td><?= $header['schedule_date']; ?></td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td><?= $header['start_time']; ?> - <?= $header['end_time']; ?></td>
            </tr>
        </table>

        <div class="section-title">Daftar Member yang Booking</div>
        
        <table class="members-table">
            <thead>
                <tr>
                    <th class="no">No.</th>
                    <th>Nama Member</th>
                    <th class="time">Waktu Booking</th>
                    <th class="status">Status Booking</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach($detail as $data) : ?>
                <tr>
                    <td class="no"><?= $no++; ?></td>
                    <td><?= $data['name']; ?></td>
                    <td class="time"><?= $data['booking_time']; ?></td>
                    <td class="status"><?= $data['status']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="signature">
            Tanda Tangan Petugas: ____________________
        </div>
    </div>
</body>
</html>