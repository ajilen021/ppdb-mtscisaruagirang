<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Admin Panel') ?> | PPDB MTs Cisarua Girang</title>
    <link rel="icon" href="<?= base_url('assets/img/logo-cisarua-girang.jpg') ?>" type="image/png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE/dist/css/AdminLTE.min.css') ?>">

    <style>
        /* Opsi: Tambahkan style custom di sini jika perlu */
        .nav-sidebar .nav-link.active {
            background-color: #007bff !important;
            color: #fff !important;
        }

        .nav-sidebar .nav-link.active {
            background-color: #007bff !important;
            color: #fff !important;
        }

        .modal-dialog-scrollable .modal-body {
            max-height: 70vh; /* Anda bisa sesuaikan 70vh (70% tinggi layar) */
            overflow-y: auto;
        }

    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader (Opsi, bisa dihapus jika tidak suka) -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="<?= base_url('assets/img/logo-cisarua-girang.png') ?>" alt="Logo" height="60" width="60">
        </div>

        <!-- Navbar (Topbar) -->
        <?= $this->include('admin/layout/topbar') ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?= $this->include('admin/layout/sidebar') ?>

        <!-- Content Wrapper. Berisi konten halaman -->
        <div class="content-wrapper">
            <!-- Pesan Alert (jika ada) -->
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <!-- Render Konten Utama Halaman -->
            <?= $this->renderSection('content') ?>

        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Konten control sidebar bisa ditaruh di sini -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2024-<?= date('Y') ?> <a href="#">PPDB MTs Cisarua Girang</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="<?= base_url('assets/AdminLTE/plugins/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url('assets/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url('assets/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/AdminLTE/dist/js/AdminLTE.js') ?>"></script>

    <?= $this->renderSection('pageScripts') ?>

</body>

</html>

