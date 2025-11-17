<nav class="navbar navbar-expand-lg bg-light border-bottom sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="<?= site_url('/') ?>">
            <img src="<?= base_url('assets/img/logo-cisarua-girang.jpg') ?>" alt="Logo MTs Cisarua Girang" style="height: 40px; width: auto;" class="me-2">
            <span class="fs-5 fw-bold">MTs Cisarua Girang</span>
        </a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item">
                     <a class="nav-link <?= (service('uri')->getSegment(1) == '') ? 'active fw-bold' : '' ?>" aria-current="page" href="<?= site_url('/') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <?php
                    // Logika link Daftar/Status (Tetap sama)
                    $pendaftarHeader = null;
                    if (session()->get('isLoggedIn')) {
                        $pendaftarModelHeader = new \App\Models\PendaftarModel();
                        $pendaftarHeader = $pendaftarModelHeader->getPendaftarByUserId(session()->get('id'));
                    }
                    $isPendaftaranPage = (service('uri')->getSegment(1) == 'pendaftaran' && service('uri')->getSegment(2) != 'success');
                    $isBuktiPage = (service('uri')->getSegment(1) == 'pendaftaran' && service('uri')->getSegment(2) == 'bukti');
                    ?>
                    <?php if (session()->get('isLoggedIn') && $pendaftarHeader) : ?>
                         <a class="nav-link <?= $isBuktiPage ? 'active fw-bold' : '' ?>" href="<?= site_url('pendaftaran/bukti') ?>">Status Pendaftaran</a>
                    <?php else : ?>
                         <a class="nav-link <?= $isPendaftaranPage ? 'active fw-bold' : '' ?>" href="<?= session()->get('isLoggedIn') ? site_url('pendaftaran') : site_url('login') ?>">Daftar</a>
                    <?php endif; ?>
                </li>
            </ul>

            <div class="d-flex align-items-center">
                <?php if (session()->get('isLoggedIn')) : ?>
                    <span class="navbar-text me-3">
                        Halo, <?= esc(session()->get('email')); ?>
                    </span>
                     <a href="<?= site_url('logout') ?>" class="btn btn-outline-danger btn-sm">Logout</a>
                <?php else : ?>
                     <a href="<?= site_url('login') ?>" class="btn btn-outline-primary btn-sm me-2">Login</a>
                     <a href="<?= site_url('register') ?>" class="btn btn-primary btn-sm">Register</a>
                <?php endif; ?>
            </div>
        </div>
        </div>
    </nav>