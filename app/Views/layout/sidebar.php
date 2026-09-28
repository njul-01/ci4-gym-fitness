<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Gym-Fitness'; ?></title>

    <!-- Bootstrap 5 & icon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: #f8f9fa;
        min-height: 100vh;
        overflow-x: hidden;
    }

    body h4 {
        font-family: 'Poppins', sans-serif;
        color: #7c3aed;
    }

    /* ============ SIDEBAR - NO SCROLLBAR ============ */
    .sidebar {
        width: 280px;
        background: #ffffff;
        padding: 20px;
        border-right: 1px solid #e5e7eb;
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
        height: 100vh;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: left 0.3s ease;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .logo-section {
        flex-shrink: 0;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
        border-bottom: 2px solid #7c3aed;
    }

    .logo-section h3 {
        color: #1f2937;
        font-size: 1.5rem;
        font-weight: 800;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .logo-section .logo-icon {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        box-shadow: 0 6px 16px rgba(124, 58, 237, 0.4);
    }

    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
    }

    .sidebar-menu li {
        margin: 0;
    }

    .sidebar-menu a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0.85rem 1rem;
        color: #6b7280;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    .sidebar-menu a i {
        font-size: 1.2rem;
        width: 22px;
        text-align: center;
        flex-shrink: 0;
        transition: transform 0.2s ease;
    }

    .sidebar-menu a:hover {
        background: #f3f4f6;
        color: #7c3aed;
    }

    .sidebar-menu a:hover i {
        transform: scale(1.1);
    }

    .sidebar-menu a.active {
        background: #7c3aed;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
    }

    .sidebar-menu a.active i {
        color: #ffffff;
    }

    .sidebar-footer {
        flex-shrink: 0;
        padding-top: 1rem;
        border-top: 2px solid #e5e7eb;
    }

    .sidebar-footer a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0.85rem 1rem;
        color: #6b7280;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        white-space: nowrap;
        margin-bottom: 0.5rem;
    }

    .sidebar-footer a:hover {
        background: #f3f4f6;
        color: #7c3aed;
    }

    .sidebar-footer a i {
        font-size: 1.1rem;
        width: 22px;
        text-align: center;
        flex-shrink: 0;
    }

    .copyright-text {
        margin-top: 1rem;
        padding-top: 0.75rem;
        text-align: center;
        font-size: 0.7rem;
        color: #9ca3af;
        border-top: 1px solid #e5e7eb;
        line-height: 1.4;
    }

    /* ============ MAIN AREA ============ */
    .main-area {
        margin-left: 280px;
        background: #f8f9fa;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* ============ TOPBAR ============ */
    .topbar {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        padding: 1.5rem 2rem;
        border-radius: 15px; 
        margin: 20px 20px 10px 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .page-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #7c3aed;
        margin-bottom: 0.25rem;
    }

    .topbar .small {
        color: #6b7280;
        font-size: 0.9rem;
    }

    .topbar strong {
        color: #1f2937;
        font-weight: 600;
    }

    /* ============ CONTENT WRAPPER ============ */
    .content-wrapper {
        flex: 1;
        padding: 20px;
    }

    /* Cards */
    .card {
        border: 1px solid #e5e7eb;
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        background: #ffffff;
        transition: all 0.3s ease;
        margin-bottom: 1.5rem;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(124, 58, 237, 0.15);
        border-color: #7c3aed;
    }

    /* Stats Container */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .card-stats-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-stats-info h3 {
        font-size: 36px;
        font-weight: bold;
        margin: 10px 0 0 0;
        color: #7c3aed;
    }

    .card-stats-info p {
        color: #1f2937;
        font-size: 14px;
        margin: 0;
        font-weight: 500;
    }

    .icon-box {
        background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
        width: 70px;
        height: 70px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: white;
        box-shadow: 0 8px 24px rgba(124, 58, 237, 0.4);
    }

    /* Table Styles */
    .table {
        color: #1f2937;
        margin-bottom: 0;
    }

    .table thead th {
        background: #f3f4f6;
        color: #1f2937;
        padding: 1rem;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border: none;
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-color: #e5e7eb;
    }

    .table tbody tr {
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background: #f9fafb;
    }

    /* Visitor Avatar */
    .visitor-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #7c3aed;
    }

    /* Chart Container */
    .chart-container {
        position: relative;
        height: 300px;
        padding: 1rem;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .main-area {
            margin-left: 280px;
        }
    }

    @media (max-width: 992px) {
        .sidebar {
            left: -280px;
        }

        .sidebar.active {
            left: 0;
        }

        .main-area {
            margin-left: 0;
        }

        .topbar {
            margin: 20px 15px 10px 15px;
        }

        .stats-container {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .topbar {
            padding: 1rem;
        }

        .page-title {
            font-size: 1.3rem;
        }

        .stats-container {
            grid-template-columns: 1fr;
        }

        .card-stats-info h3 {
            font-size: 28px;
        }

        .icon-box {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }
    }

    /* Mobile Toggle Button */
    .mobile-toggle {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #7c3aed;
        border: none;
        color: white;
        font-size: 24px;
        box-shadow: 0 8px 24px rgba(124, 58, 237, 0.4);
        z-index: 999;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .mobile-toggle:hover {
        transform: scale(1.1);
        background: #6d28d9;
    }

    @media (max-width: 992px) {
        .mobile-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    }

    /* Sidebar Overlay */
    .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    .sidebar-overlay.active {
        display: block;
    }

    /* ============ PAGINATION STYLES ============ */
    .pagination {
        display: flex !important;
        gap: 8px !important;
        margin-bottom: 0 !important;
        justify-content: center !important;
        flex-wrap: wrap !important;
        padding: 0 !important;
        list-style: none !important;
    }

    .pagination .page-item {
        margin: 0 !important;
    }

    .pagination .page-link {
        background: #ffffff !important;
        border: 1px solid #e5e7eb !important;
        color: #1f2937 !important;
        padding: 0.6rem 1rem !important;
        border-radius: 10px !important;
        transition: all 0.3s ease !important;
        font-weight: 500 !important;
        min-width: 40px !important;
        text-align: center !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        text-decoration: none !important;
    }

    .pagination .page-link:hover {
        background: #f3f4f6 !important;
        border-color: #7c3aed !important;
        color: #7c3aed !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 4px 15px rgba(124, 58, 237, 0.2) !important;
    }

    .pagination .page-item.active .page-link {
        background: #7c3aed !important;
        border-color: #7c3aed !important;
        color: white !important;
        box-shadow: 0 4px 15px rgba(124, 58, 237, 0.4) !important;
        font-weight: 700 !important;
    }

    .pagination .page-item.disabled .page-link {
        background: #f9fafb !important;
        border-color: #e5e7eb !important;
        color: #9ca3af !important;
        cursor: not-allowed !important;
        opacity: 0.6 !important;
    }

    /* Responsive pagination */
    @media (max-width: 576px) {
        .pagination .page-link {
            padding: 0.5rem 0.75rem !important;
            font-size: 0.875rem !important;
            min-width: 35px !important;
        }
    }

    /* ============ BUTTONS ============ */
    .btn-primary {
        background: #7c3aed;
        border: none;
        color: white;
        padding: 0.7rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(124, 58, 237, 0.5);
        background: #6d28d9;
    }

    .btn-secondary {
        background: #6b7280;
        border: none;
        color: white;
        padding: 0.7rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(107, 114, 128, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(107, 114, 128, 0.5);
        background: #4b5563;
    }

    .btn-success {
        background: #10b981;
        border: none;
        color: white;
        padding: 0.7rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.5);
        background: #059669;
    }

    .btn-danger {
        background: #ef4444;
        border: none;
        color: white;
        padding: 0.7rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.5);
        background: #dc2626;
    }

    .btn-warning {
        background: #f59e0b;
        border: none;
        color: white;
        padding: 0.7rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 158, 11, 0.5);
        background: #d97706;
    }

    /* Button Group */
    .btn-group-horizontal {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    /* Responsive button sizing */
    @media (max-width: 576px) {
        .btn-primary, .btn-secondary, .btn-success, .btn-danger, .btn-warning {
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
        }
    }

    /* Badge */
    .badge {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 500;
    }

    .badge.bg-success {
        background: #10b981 !important;
    }

    .badge.bg-danger {
        background: #ef4444 !important;
    }

    .badge.bg-warning {
        background: #f59e0b !important;
    }

    .badge.bg-primary {
        background: #7c3aed !important;
    }

    /* ============ FORM INPUTS ============ */
    .form-control, .form-select {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        color: #1f2937;
        padding: 0.7rem 1rem;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        background: #ffffff;
        border-color: #7c3aed;
        color: #1f2937;
        box-shadow: 0 0 0 0.2rem rgba(124, 58, 237, 0.15);
    }

    .form-control::placeholder {
        color: #9ca3af;
    }

    .form-label {
        color: #1f2937;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    /* Input Group */
    .input-group .btn {
        border-radius: 0 10px 10px 0;
    }

    .input-group .form-control {
        border-radius: 10px 0 0 10px;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 1.5rem;
        flex-wrap: wrap;
    }
    </style>
</head>
<body>

<?php
    $uri = service('uri');
    $segments = $uri->getSegments();

    $segment  = $segments[0] ?? '';
    $segment2 = $segments[1] ?? '';
    $role = session()->get('role');
?>

<!-- Sidebar Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <!-- Logo Section -->
    <div class="logo-section">
        <h3>
            <span class="logo-icon"><i class="bi bi-lightning-charge-fill"></i></span>
            FitCourse
        </h3>
    </div>

    <!-- Menu -->
    <ul class="sidebar-menu">
        <li>
            <a href="<?= base_url('/'); ?>" class="<?= $segment == '' ? 'active' : '' ?>">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <?php if($role === 'staff'):?>
        <li>
            <a href="<?= base_url('members'); ?>" class="<?= $segment == 'members' ? 'active' : '' ?>">
                <i class="bi bi-people-fill"></i>
                <span>Members</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url('membership'); ?>" class="<?= $segment == 'membership' ? 'active' : '' ?>">
                <i class="bi bi-credit-card-fill"></i>
                <span>Membership</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url('trainers'); ?>" class="<?= $segment == 'trainers' ? 'active' : '' ?>">
                <i class="bi bi-person-badge-fill"></i>
                <span>Trainers</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url('classes'); ?>" class="<?= $segment == 'classes' ? 'active' : '' ?>">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>Classes</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url('schedule'); ?>" class="<?= $segment == 'schedule' ? 'active' : '' ?>">
                <i class="bi bi-calendar-event-fill"></i>
                <span>Schedule</span>
            </a>
        </li>
        <?php elseif($role === 'kepala'):?>
        <li>
            <a href="<?= base_url('laporan/schedule'); ?>"
            class="<?= ($segment == 'laporan' && $segment2 == 'schedule') ? 'active' : '' ?>">
                <i class="bi bi-arrow-left-right"></i>
                <span>Laporan Schedule</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url('laporan/membership'); ?>"
            class="<?= ($segment == 'laporan' && $segment2 == 'membership') ? 'active' : '' ?>">
                <i class="bi bi-people"></i>
                <span>Laporan Membership</span>
            </a>
        </li>
        <?php endif; ?>
    </ul>

    <!-- Footer -->
    <div class="sidebar-footer">
        <a href="<?= base_url('logout'); ?>">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </a>

        <div class="copyright-text">
            &copy; <?= date('Y') ?> Gym-Jumar<br>
            <small>Veteran Tangerang</small>
        </div>
    </div>
</div>

<!-- Mobile Toggle Button -->
<button class="mobile-toggle" id="mobileToggle">
    <i class="bi bi-list"></i>
</button>



    

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Mobile sidebar toggle
const mobileToggle = document.getElementById('mobileToggle');
const sidebar = document.getElementById('sidebar');
const sidebarOverlay = document.getElementById('sidebarOverlay');

if (mobileToggle && sidebar && sidebarOverlay) {
    mobileToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
        sidebarOverlay.classList.toggle('active');
    });

    sidebarOverlay.addEventListener('click', function() {
        sidebar.classList.remove('active');
        sidebarOverlay.classList.remove('active');
    });

    // Close sidebar when clicking menu item on mobile
    if (window.innerWidth <= 992) {
        const menuLinks = document.querySelectorAll('.sidebar-menu a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function() {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
            });
        });
    }
}
</script>

</body>
</html>