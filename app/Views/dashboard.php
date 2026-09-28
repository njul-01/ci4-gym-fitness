<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    
    <!-- Hero Section -->
    <div class="hero-section-gym mb-4">
        <div class="hero-content-gym">
            <div class="hero-text-gym">
                <span class="hero-badge-gym">WELCOME</span>
                <h1 class="hero-title-gym">FITCOURSE</h1>
                <p class="hero-description-gym">
                    Platform manajemen gym yang komprehensif dan mudah digunakan 
                    untuk mengelola member, kelas, dan trainer. Dengan sistem yang 
                    terintegrasi dan dashboard yang informatif, Anda dapat memantau 
                    aktivitas gym secara real-time dan mengoptimalkan operasional 
                    untuk mencapai target bisnis fitness Anda.
                </p>
            </div>
            <div class="hero-image-gym">
                <div class="hero-icon-wrapper-gym">
                    <i class="fas fa-dumbbell hero-icon-gym"></i>
                    <i class="fas fa-heart-pulse hero-icon-small-gym"></i>
                </div>
                <div class="hero-label-gym">PLATFORM - GYM & FITNESS</div>
            </div>
        </div>
    </div>

    <!-- Dashboard Header -->
    <div class="header mb-4">
        <h4 style="color: #7c3aed; font-size: 1.5rem; font-weight: 700;">
            <i class="bi bi-speedometer2 me-2"></i>Dashboard Overview
        </h4>
    </div>
        
    <!-- TOP 4 STATISTICS CARDS -->
    <div class="row g-3 mb-3">
        
        <!-- Total Members Card -->
        <div class="col-lg-3 col-md-6">
            <div class="compact-card">
                <div class="compact-content">
                    <div class="compact-info">
                        <p class="compact-label">Total Members</p>
                        <h3 class="compact-number"><?= $totalMembers ?></h3>
                    </div>
                    <div class="compact-icon compact-icon-purple">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Memberships Card -->
        <div class="col-lg-3 col-md-6">
            <div class="compact-card">
                <div class="compact-content">
                    <div class="compact-info">
                        <p class="compact-label">Total Memberships</p>
                        <h3 class="compact-number"><?= $totalMembership ?></h3>
                    </div>
                    <div class="compact-icon compact-icon-purple">
                        <i class="bi bi-credit-card-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Trainers Card -->
        <div class="col-lg-3 col-md-6">
            <div class="compact-card">
                <div class="compact-content">
                    <div class="compact-info">
                        <p class="compact-label">Total Trainers</p>
                        <h3 class="compact-number"><?= $totalTrainers ?></h3>
                    </div>
                    <div class="compact-icon compact-icon-purple">
                        <i class="bi bi-person-badge-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Kelas Card -->
        <div class="col-lg-3 col-md-6">
            <div class="compact-card">
                <div class="compact-content">
                    <div class="compact-info">
                        <p class="compact-label">Total Kelas</p>
                        <h3 class="compact-number"><?= $totalKelas ?></h3>
                    </div>
                    <div class="compact-icon compact-icon-purple">
                        <i class="bi bi-calendar-event-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BOTTOM 3 SCHEDULE STATUS CARDS -->
    <div class="mb-3">
        <h5 class="section-title-simple mb-3">
            <i class="bi bi-calendar-check me-2" style="color: #7c3aed;"></i>
            Ringkasan Status Jadwal Kelas
        </h5>
        
        <div class="row g-3">
            
            <!-- Jadwal Selesai -->
            <div class="col-lg-4 col-md-6">
                <div class="compact-card">
                    <div class="compact-content">
                        <div class="compact-info">
                            <p class="compact-label">Jadwal Sudah Selesai</p>
                            <h3 class="compact-number"><?= $jadwalSelesai ?></h3>
                        </div>
                        <div class="compact-icon compact-icon-purple">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jadwal Sedang Berjalan -->
            <div class="col-lg-4 col-md-6">
                <div class="compact-card">
                    <div class="compact-content">
                        <div class="compact-info">
                            <p class="compact-label"> Jadwal Sedang Berjalan</p>
                            <h3 class="compact-number"><?= $jadwalBerjalan ?></h3>
                        </div>
                        <div class="compact-icon compact-icon-purple">
                            <i class="bi bi-clock-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jadwal Dibatalkan -->
            <div class="col-lg-4 col-md-6">
                <div class="compact-card">
                    <div class="compact-content">
                        <div class="compact-info">
                            <p class="compact-label"> Jadwal Dibatalkan</p>
                            <h3 class="compact-number"><?= $jadwalBatal ?></h3>
                        </div>
                        <div class="compact-icon compact-icon-purple">
                            <i class="bi bi-x-circle-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Member Table & Trainer Chart -->
    <div class="row g-4 mt-2">
        
        <!-- Frequent Visitors Table -->
        <div class="col-lg-6">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 style="color: #7c3aed; font-weight: 700; margin: 0;">
                        <i class="bi bi-star-fill me-2"></i>Member Terbaru
                    </h5>
                    <span style="color: #6b7280; font-size: 0.85rem;">
                        Bulan ini
                    </span>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Member</th>
                                <th style="width: 30%;">Tipe</th>
                                <th style="width: 20%; text-align: center;">Tanggal Join</th>
                            </tr>
                        </thead>

                       <tbody>
                        <?php foreach($memberTerbaru as $member): ?>
                        <tr>
                            <!-- KOLOM MEMBER -->
                            <td>
                            <div class="d-flex align-items-center gap-3">
                            <!-- AVATAR -->
                            <div style="
                                width:40px;
                                height:40px;
                                min-width:40px;
                                border-radius:50%;
                                background:linear-gradient(135deg,#7c3aed,#a855f7);
                                display:flex;
                                align-items:center;
                                justify-content:center;
                                color:white;
                                font-weight:600;
                                font-size:0.85rem;
                            ">
                                <?= strtoupper(substr($member['name'],0,1)) ?>
                            </div>

                                    <!-- NAMA + PHONE -->
                                     <div>
                                        <div style="font-weight:600;color:#1f2937;">
                                            <?= $member['name'] ?>
                                        </div>
                                        <small style="color:#6b7280;">
                                            <?= $member['phone'] ?>
                                        </small>
                                    </div>
                                </div>
                            </td>

                            <!-- KOLOM TIPE -->
                            <td>
                                <span style="
                                    background:#ede9fe;
                                    color:#7c3aed;
                                    padding:6px 12px;
                                    border-radius:8px;
                                    font-weight:500;
                                    font-size:0.85rem;
                                ">
                                    <?= ucfirst($member['membership']) ?>
                                </span>
                            </td>

                            <!-- KOLOM TANGGAL DAFTAR -->
                            <td style="text-align:center; white-space:nowrap;">
                                <span style="
                                    background:#ede9fe;
                                    color:#7c3aed;
                                    padding:6px 10px;
                                    border-radius:8px;
                                    font-weight:600;
                                    font-size:0.8rem;
                                ">
                                    <?= date('d M Y', strtotime($member['join_date'])) ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Chart 1: Trainer Paling Aktif Ngajar -->
        <div class="col-lg-6">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 style="color: #7c3aed; font-weight: 700; margin: 0;">
                        <i class="bi bi-person-fill-check me-2"></i>Trainer Paling Aktif Ngajar
                    </h5>
                    <span style="color: #6b7280; font-size: 0.85rem;">
                        Total Schedule
                    </span>
                </div>
                
                <div class="chart-container" style="height: 300px;">
                    <canvas id="trainerChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- 2 Grafik -->
    <div class="row g-4 mt-2">
        
        <!-- Chart 2: Member Yang Sering Berlangganan -->
        <div class="col-lg-6">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 style="color: #7c3aed; font-weight: 700; margin: 0;">
                        <i class="bi bi-people-fill me-2"></i>Member Sering Berlangganan
                    </h5>
                    <span style="color: #6b7280; font-size: 0.85rem;">
                        Total Membership
                    </span>
                </div>
                
                <div class="chart-container" style="height: 300px;">
                    <canvas id="memberChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Chart 3: Class Yang Paling Diminati -->
        <div class="col-lg-6">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 style="color: #7c3aed; font-weight: 700; margin: 0;">
                        <i class="bi bi-bar-chart-fill me-2"></i>Kelas Yang Paling Diminati
                    </h5>
                    <span style="color: #6b7280; font-size: 0.85rem;">
                        Total Schedule
                    </span>
                </div>
                
                <div class="chart-container" style="height: 300px;">
                    <canvas id="classChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Jadwal Kelas Bulan Ini -->
    <div class="row g-4 mt-2">
        <div class="col-12">
            <div class="card">
               <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 style="color:#7c3aed;font-weight:700;margin:0;">
                        <i class="bi bi-calendar-month-fill me-2"></i>Status Jadwal Bulan Ini
                    </h5>

                    <div class="d-flex align-items-center gap-2">
                        <!-- FILTER BULAN -->
                        <form method="get">
                            <select name="month"
                                    class="form-select form-select-sm"
                                    onchange="this.form.submit()"
                                    style="width:160px">
                                <?php for ($i = -6; $i <= 1; $i++):
                                    $month = date('Y-m', strtotime("$i month"));
                                ?>
                                    <option value="<?= $month ?>"
                                        <?= $selectedMonth === $month ? 'selected' : '' ?>>
                                        <?= date('F Y', strtotime($month)) ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </form>

                        <!-- FILTER STATUS -->
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-purple active" data-filter="all">Semua</button>
                            <button type="button" class="btn btn-outline-purple" data-filter="Finish">Selesai</button>
                            <button type="button" class="btn btn-outline-purple" data-filter="ongoing">Berjalan</button>
                            <button type="button" class="btn btn-outline-purple" data-filter="canceled">Gagal</button>
                        </div>
                    </div>
                </div>

                <!-- Summary Cards -->
                <div class="row g-3" id="scheduleStatsContainer">
                    <!-- Card Finished -->
                    <div class="col-md-3 schedule-filter-card" data-status="Finish">
                        <div style="
                            padding: 2rem;
                            border-radius: 16px;
                            background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(5, 150, 105, 0.05));
                            border: 2px solid #10b981;
                            text-align: center;
                            transition: all 0.3s ease;
                            min-height: 280px;
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                        " class="status-card-filter">
                            <div style="
                                width: 70px;
                                height: 70px;
                                margin: 0 auto 1rem;
                                border-radius: 16px;
                                background: #10b981;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                box-shadow: 0 8px 16px rgba(16, 185, 129, 0.3);
                            ">
                                <i class="bi bi-check-circle-fill" style="font-size: 2rem; color: white;"></i>
                            </div>
                            <h2 style="color: #10b981; font-weight: 700; margin-bottom: 0.5rem; font-size: 3rem; line-height: 1;">
                                <?= $finishedThisMonth ?>
                            </h2>
                            <p style="color: #6b7280; margin: 0; font-weight: 600; font-size: 1.1rem; line-height: 1.3;">
                                Jadwal Selesai
                            </p>
                            <small style="color: #10b981; font-weight: 500; margin-top: 0.5rem; display: block; line-height: 1.3;">
                                ✓ Successfully Completed
                            </small>
                        </div>
                    </div>

                    <!-- Card Ongoing -->
                    <div class="col-md-3 schedule-filter-card" data-status="ongoing">
                        <div style="
                            padding: 2rem;
                            border-radius: 16px;
                            background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(217, 119, 6, 0.05));
                            border: 2px solid #f59e0b;
                            text-align: center;
                            transition: all 0.3s ease;
                            min-height: 280px;
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                        " class="status-card-filter">
                            <div style="
                                width: 70px;
                                height: 70px;
                                margin: 0 auto 1rem;
                                border-radius: 16px;
                                background: #f59e0b;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                box-shadow: 0 8px 16px rgba(245, 158, 11, 0.3);
                            ">
                                <i class="bi bi-clock-fill" style="font-size: 2rem; color: white;"></i>
                            </div>
                            <h2 style="color: #f59e0b; font-weight: 700; margin-bottom: 0.5rem; font-size: 3rem; line-height: 1;">
                                <?= $ongoingThisMonth ?>
                            </h2>
                            <p style="color: #6b7280; margin: 0; font-weight: 600; font-size: 1.1rem; line-height: 1.3;">
                                Jadwal Berjalan
                            </p>
                            <small style="color: #f59e0b; font-weight: 500; margin-top: 0.5rem; display: block; line-height: 1.3;">
                                ⟳ In Progress
                            </small>
                        </div>
                    </div>

                    <!-- Card Canceled -->
                    <div class="col-md-3 schedule-filter-card" data-status="canceled">
                        <div style="
                            padding: 2rem;
                            border-radius: 16px;
                            background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(220, 38, 38, 0.05));
                            border: 2px solid #ef4444;
                            text-align: center;
                            transition: all 0.3s ease;
                            min-height: 280px;
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                        " class="status-card-filter">
                            <div style="
                                width: 70px;
                                height: 70px;
                                margin: 0 auto 1rem;
                                border-radius: 16px;
                                background: #ef4444;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                box-shadow: 0 8px 16px rgba(239, 68, 68, 0.3);
                            ">
                                <i class="bi bi-x-circle-fill" style="font-size: 2rem; color: white;"></i>
                            </div>
                            <h2 style="color: #ef4444; font-weight: 700; margin-bottom: 0.5rem; font-size: 3rem; line-height: 1;">
                                <?= $canceledThisMonth ?>
                            </h2>
                            <p style="color: #6b7280; margin: 0; font-weight: 600; font-size: 1.1rem; line-height: 1.3;">
                                Jadwal Gagal
                            </p>
                            <small style="color: #ef4444; font-weight: 500; margin-top: 0.5rem; display: block; line-height: 1.3;">
                                ✕ Canceled
                            </small>
                        </div>
                    </div>

                    <!-- Card Total -->
                    <div class="col-md-3 schedule-filter-card" data-status="all">
                        <div style="
                            padding: 2rem;
                            border-radius: 16px;
                            background: linear-gradient(135deg, rgba(124, 58, 237, 0.15), rgba(109, 40, 217, 0.05));
                            border: 2px solid #7c3aed;
                            text-align: center;
                            transition: all 0.3s ease;
                            min-height: 280px;
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                        " class="status-card-filter">
                            <div style="
                                width: 70px;
                                height: 70px;
                                margin: 0 auto 1rem;
                                border-radius: 16px;
                                background: #7c3aed;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                box-shadow: 0 8px 16px rgba(124, 58, 237, 0.3);
                            ">
                                <i class="bi bi-calendar-check-fill" style="font-size: 2rem; color: white;"></i>
                            </div>
                            <h2 style="color: #7c3aed; font-weight: 700; margin-bottom: 0.5rem; font-size: 3rem; line-height: 1;">
                                <?= $totalThisMonth ?>
                            </h2>
                            <p style="color: #6b7280; margin: 0; font-weight: 600; font-size: 1.1rem; line-height: 1.3;">
                                Total Jadwal
                            </p>
                            <small style="color: transparent; font-weight: 500; margin-top: 0.5rem; display: block; line-height: 1.3;">
                                ‎ 
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap');

/* Hero Section Styles */
.hero-section-gym {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 24px;
    padding: 3rem;
    color: white;
    position: relative;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(102, 126, 234, 0.3);
}

.hero-section-gym::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 500px;
    height: 500px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
}

.hero-content-gym {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    z-index: 1;
    gap: 3rem;
}

.hero-text-gym {
    flex: 1;
}

.hero-badge-gym {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 1px;
    display: inline-block;
    margin-bottom: 1rem;
}

.hero-title-gym {
    font-size: 3.5rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 1rem;
    letter-spacing: -1px;
}

.hero-description-gym {
    font-size: 1rem;
    line-height: 1.7;
    opacity: 0.95;
    margin-bottom: 0;
}

.hero-image-gym {
    text-align: center;
    flex-shrink: 0;
}

.hero-icon-wrapper-gym {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(20px);
    width: 200px;
    height: 200px;
    border-radius: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    margin: 0 auto 1rem;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
}

.hero-icon-gym {
    font-size: 5rem;
    color: white;
}

.hero-icon-small-gym {
    font-size: 2rem;
    position: absolute;
    top: 20px;
    right: 20px;
    background: rgba(255, 255, 255, 0.2);
    padding: 12px;
    border-radius: 12px;
}

.hero-label-gym {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 10px 24px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 1px;
    display: inline-block;
}

/* COMPACT CARD STYLES - ALL CARDS */
.compact-card {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    border: 1px solid #f3f4f6;
    transition: all 0.2s ease;
    height: 100%;
    min-height: 140px;
    display: flex;
    align-items: center;
}

.compact-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
}

.compact-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    width: 100%;
}

.compact-info {
    flex: 1;
}

.compact-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #6b7280;
    margin-bottom: 0.75rem;
    line-height: 1.3;
    font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    min-height: 2.4em;
    display: flex;
    align-items: center;
}

.compact-number {
    font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1;
    margin: 0;
    color: #7c3aed;
}

.compact-icon {
    width: 60px;
    height: 60px;
    min-width: 60px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    color: white;
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.25);
}

.compact-icon-purple {
    background: linear-gradient(135deg, #7c3aed, #a855f7);
}

.section-title-simple {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1f2937;
    margin-top: 2rem;
}

/* Button Styles */
.btn-outline-purple {
    color: #7c3aed;
    border-color: #7c3aed;
    transition: all 0.3s ease;
}

.btn-outline-purple:hover {
    background-color: #7c3aed;
    border-color: #7c3aed;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
}

.btn-outline-purple.active {
    background-color: #7c3aed;
    border-color: #7c3aed;
    color: white;
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
}

/* Chart Container */
.chart-container {
    position: relative;
}

/* Filter Cards Hover */
.status-card-filter:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
}

.schedule-filter-card {
    transition: all 0.3s ease;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-content-gym {
        flex-direction: column;
        text-align: center;
        gap: 2rem;
    }

    .hero-title-gym {
        font-size: 2.5rem;
    }

    .stat-number {
        font-size: 2.5rem;
    }

    .schedule-number {
        font-size: 2.25rem;
    }
}
</style>

<script>
// Charts initialization
const trainerCtx = document.getElementById('trainerChart');
if (trainerCtx) {
    new Chart(trainerCtx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($trainersLabels) ?>,
            datasets: [{
                label: 'Total Schedule',
                data: <?= json_encode($trainersData) ?>,
                backgroundColor: [
                    'rgba(124, 58, 237, 0.8)',
                    'rgba(139, 92, 246, 0.8)',
                    'rgba(167, 139, 250, 0.8)',
                    'rgba(196, 181, 253, 0.8)',
                    'rgba(221, 214, 254, 0.8)'
                ],
                borderColor: [
                    '#7c3aed',
                    '#8b5cf6',
                    '#a78bfa',
                    '#c4b5fd',
                    '#ddd6fe'
                ],
                borderWidth: 2,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(255, 255, 255, 0.95)',
                    titleColor: '#7c3aed',
                    bodyColor: '#1f2937',
                    borderColor: '#7c3aed',
                    borderWidth: 2,
                    padding: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Total Schedule: ' + context.parsed.y + ' kelas';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#e5e7eb', drawBorder: false },
                    ticks: { color: '#6b7280', font: { size: 12, weight: '500' } }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#6b7280', font: { size: 11, weight: '500' } }
                }
            }
        }
    });
}

const memberCtx = document.getElementById('memberChart');
if (memberCtx) {
    new Chart(memberCtx, {
        type: 'doughnut',
        data: {
            labels: <?= json_encode($memberLabels) ?>,
            datasets: [{
                label: 'Total Berlangganan',
                data: <?= json_encode($memberData) ?>,
                backgroundColor: [
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(5, 150, 105, 0.8)',
                    'rgba(4, 120, 87, 0.8)',
                    'rgba(6, 95, 70, 0.8)',
                    'rgba(6, 78, 59, 0.8)'
                ],
                borderColor: '#ffffff',
                borderWidth: 3,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: { 
                    display: true,
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: { size: 12, weight: '500' },
                        color: '#6b7280',
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(255, 255, 255, 0.95)',
                    titleColor: '#10b981',
                    bodyColor: '#1f2937',
                    borderColor: '#10b981',
                    borderWidth: 2,
                    padding: 12,
                    displayColors: true,
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return label + ': ' + value + ' membership (' + percentage + '%)';
                        }
                    }
                }
            }
        }
    });
}

const classCtx = document.getElementById('classChart');
if (classCtx) {
    new Chart(classCtx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($classLabels) ?>,
            datasets: [{
                label: 'Total Schedule',
                data: <?= json_encode($classData) ?>,
                backgroundColor: [
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(217, 119, 6, 0.8)',
                    'rgba(180, 83, 9, 0.8)',
                    'rgba(146, 64, 14, 0.8)',
                    'rgba(120, 53, 15, 0.8)'
                ],
                borderColor: [
                    '#f59e0b',
                    '#d97706',
                    '#b45309',
                    '#92400e',
                    '#78350f'
                ],
                borderWidth: 2,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(255, 255, 255, 0.95)',
                    titleColor: '#f59e0b',
                    bodyColor: '#1f2937',
                    borderColor: '#f59e0b',
                    borderWidth: 2,
                    padding: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Total Schedule: ' + context.parsed.y + ' kelas';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#e5e7eb', drawBorder: false },
                    ticks: { color: '#6b7280', font: { size: 12, weight: '500' } }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#6b7280', font: { size: 11, weight: '500' } }
                }
            }
        }
    });
}

// Filter functionality
document.querySelectorAll('[data-filter]').forEach(btn => {
    btn.addEventListener('click', function() {
        const filter = this.getAttribute('data-filter');
        
        document.querySelectorAll('[data-filter]').forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        document.querySelectorAll('.schedule-filter-card').forEach(card => {
            const status = card.getAttribute('data-status');
            if (filter === 'all') {
                card.style.display = 'block';
            } else if (status === filter) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
</script>

<?= $this->endSection(); ?>