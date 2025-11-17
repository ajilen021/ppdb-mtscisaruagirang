<footer class="py-5 bg-dark text-white mt-auto">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <h5>MTs Cisarua Girang</h5>
                <p class="small">
                    Terwujudnya siswa/siswi paham dalam agama, berilmu disertai amal, beramal disertai ilmu dan mampu menghadapi persaingan dan tantangan zaman
                </p>
                <small>
                    Yayasan Pendidikan Islam Darul Muta’Allimin Al Islamiyah <br>
                    NSM: 121232020268 | NPSN: 69928082 | Terakreditasi "B"
                </small>
            </div>

            <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                <h5>Link Cepat</h5>
                <ul class="nav flex-column small">
                    <li class="nav-item mb-2"><a href="<?= base_url('/') ?>" class="nav-link p-0 text-white-50">Beranda</a></li>
                    <?php
                    $pendaftarFooter = null;
                    if (session()->get('isLoggedIn')) {
                         $pendaftarModelFooter = new \App\Models\PendaftarModel();
                         $pendaftarFooter = $pendaftarModelFooter->getPendaftarByUserId(session()->get('id'));
                    }
                    ?>
                    <?php if (session()->get('isLoggedIn') && $pendaftarFooter): ?>
                         <li class="nav-item mb-2"><a href="<?= site_url('pendaftaran/bukti') ?>" class="nav-link p-0 text-white-50">Status Pendaftaran</a></li>
                    <?php else: ?>
                         <li class="nav-item mb-2"><a href="<?= session()->get('isLoggedIn') ? site_url('pendaftaran') : site_url('login') ?>" class="nav-link p-0 text-white-50">Daftar PPDB</a></li>
                    <?php endif; ?>
                    <li class="nav-item mb-2"><a href="<?= site_url('admin/login') ?>" class="nav-link p-0 text-white-50">Login Admin</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h5>Kontak Kami</h5>
                <ul class="nav flex-column small">
                    <li class="nav-item mb-2 d-flex">
                         <i class="bi bi-geo-alt-fill me-2 mt-1"></i>
                         <span>Jl. Selabintana No. 02, Babakan Kiara RT 23 RW 09, Desa Sukajaya, Kec. Sukabumi, Kab. Sukabumi 43151</span>
                    </li>
                    <li class="nav-item mb-2 d-flex">
                        <i class="bi bi-envelope-fill me-2 mt-1"></i>
                        <span>mtscisaruagirang@yahoo.com</span>
                    </li>
                    <li class="nav-item mb-2 d-flex">
                        <i class="bi bi-whatsapp me-2 mt-1"></i>
                        <span>Admin : +62 858-7138-5232</span>
                    </li>
                     <li class="nav-item mt-2">
                        <a href="https://web.facebook.com/profile.php?id=100066712024032" class="text-white-50 me-2"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/mts_cisaruagirang/" class="text-white-50 me-2"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.youtube.com/@mtscisaruagirang_official" class="text-white-50 me-2"><i class="bi bi-youtube"></i></a>
                        </li>
                </ul>
            </div>

             <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h5>Ekstrakurikuler</h5>
                 <ul class="nav flex-column small">
                     <li class="nav-item mb-1"><span class="text-white-50">Pramuka</span></li>
                    <li class="nav-item mb-1"><span class="text-white-50">Volly ball</span></li>
                    <li class="nav-item mb-1"><span class="text-white-50">Drum Band</span></li>
                    <li class="nav-item mb-1"><span class="text-white-50">Komputer</span></li>
                    <li class="nav-item mb-1"><span class="text-white-50">Futsal</span></li>
                </ul>
            </div>
        </div>

        <div class="text-center pt-4 mt-4 border-top border-secondary">
            <p class="small text-white-50 mb-0">&copy; <?= date('Y') ?> MTs Cisarua Girang. All rights reserved.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?= $this->renderSection('pageScripts') ?>
</body>
</html>