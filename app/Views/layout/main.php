<?= $this->include('layout/header'); ?>

<div class="layout-wrapper">

    <!-- Sidebar -->
    <?= $this->include('layout/sidebar'); ?>

    <!-- Main Area -->
    <div class="main-area">

        <!-- Topbar -->
        <nav class="topbar py-2">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <div>
                    <div class="page-title">
                        <?= $subtitle ?? ($title ?? 'Dashboard'); ?>
                    </div>
                    <div class="small text-muted">
                        Sistem Gym & Kelas Fitness
                    </div>
                </div>
             <div class="small text-muted">
            Halo, <strong><?= session('nama') ?></strong>
        </div>
    
    
            </div>
        </nav>

        <!-- Content -->
        <div class="content-wrapper">
            <div class="container-fluid">
                <?php if(session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?= $this->renderSection('content'); ?>
            </div>
        </div>

        <!-- Footer -->
        <?= $this->include('layout/footer'); ?>
    </div>

</div>