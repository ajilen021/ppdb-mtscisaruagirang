<?php
// Ambil segmen URI untuk menentukan halaman aktif
$uri = service('uri');
$segment1 = $uri->getSegment(1); // 'admin'
$segment2 = $uri->getSegment(2); // 'dashboard', 'pendaftar', dll.
?>

<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('/admin/dashboard') ?>" class="brand-link" style="background-color: #343a40; color: #4b545c;
;">
        <img src="<?= base_url('assets/img/logo-cisarua-girang.jpg') ?>" alt="Logo Sekolah" class="brand-image img-circle elevation-3" style="opacity: .5">
        <span class="brand-text font-weight-light">Admin PPDB</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <!-- Opsi: Ganti dengan gambar admin atau ikon default -->
                <img src="https://placehold.co/160x160/007bff/white?text=A" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <!-- Ambil nama admin dari session -->
                <a href="#" class="d-block"><?= esc(session()->get('admin_username') ?? 'Admin') ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="<?= base_url('/admin/dashboard') ?>" class="nav-link <?= ($segment2 == 'dashboard' || $segment2 == '') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('/admin/pendaftar') ?>" class="nav-link <?= ($segment2 == 'pendaftar') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Data Calon Siswa
                        </p>
                    </a>
                </li>

                <li class="nav-header">AKUN</li>
                <li class="nav-item">
                    <a href="<?= base_url('/admin/logout') ?>" class="nav-link bg-danger">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

