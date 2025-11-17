<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<?php
// Tentukan link dan teks tombol berdasarkan status login dan pendaftaran
$pendaftar = null;
$linkTombol = base_url('/login'); // Link default jika belum login
$teksTombol = 'Daftar Sekarang';

if (session()->get('isLoggedIn')) {
    $pendaftarModel = new \App\Models\PendaftarModel();
    $pendaftar = $pendaftarModel->getPendaftarByUserId(session()->get('id'));

    if ($pendaftar) {
        // Jika sudah login DAN sudah mengisi formulir
        $linkTombol = base_url('/pendaftaran/bukti');
        $teksTombol = 'Lihat Status Pendaftaran';
    } else {
        // Jika sudah login TAPI belum mengisi formulir
        $linkTombol = base_url('/pendaftaran');
    }
}

// Data dari file Word (Kita taruh di sini biar rapi)
$visi = "“Terwujudnya siswa/siswi paham dalam agama, berilmu disertai amal, beramal disertai ilmu dan mampu menghadapi persaingan dan tantangan zaman”"; //  3]
$misi = [
    "Meningkatkan peran dan pungsi YPIDMI sebagai penyelenggara pendidikan yang bermutu dan berkualitas tinggi", //  12]
    "Memelihara dan meningkatkan keunggulan (distingsi) MTs. Cisarua Girang dengan program Qiro’atul Qur’an, membaca kitab kuning, dan mahir dalam berbahasa Arab dan Inggris" //  13]
];
$tujuan = [
    "Mempersiapkan peserta didik yang bertaqwa kepada allah, tuhan yang maha esa dan berakhlak mulia", //  15]
    "Membekali peserta didik dengan ilmu pengetahuan dan teknologi agar melanjutkan kejenjang pendidikan yang lebih tinggi", //  16]
    "Mempersiapkan peserta didik agar menjadi manusia yang berkepribadian, cerdas, berkualitas dan berprestasi dalam bidang olahragawan dan seni", //  17]
    "Membekali peserta didik agar memiliki keterampilan teknologi informasi dan komunikasi serta mampu mengembangkan diri secara sendiri" //  18]
];
$targetLulusan = [
    "Menguasai Dzikir Ba’da Sholat", //  20]
    "Menguasai Ilmu Tajwid", //  21]
    "Mampu Memimpin Hadiah/Tawasul", //  22]
    "Menguasai Pratek Sholat Fardu, Sholat Sunnah dan Sholat Jenazah", //  23]
    "Menguasai Arti Bacaan Sholat", //  24]
    "Minimal Menghafal Juz 30 (tahfidz umum)", //  25]
    "Tahfidz Khusus 10 Juz" //  26]
];
$prestasi = [ // 
    ['jenis' => 'Juara 2 Semapore', 'tahun' => 2024, 'tingkat' => 'Kecamatan', 'ket' => 'Kwartir Ranting Sukabumi'],
    ['jenis' => 'Juara 3 Yel Yel', 'tahun' => 2024, 'tingkat' => 'Kecamatan', 'ket' => 'Kwartir Ranting Sukabumi'],
    ['jenis' => 'Juara 2 Memanah', 'tahun' => 2024, 'tingkat' => 'Kecamatan', 'ket' => 'Kwartir Ranting Sukabumi'],
    ['jenis' => 'Juara 5 Futsal Putra', 'tahun' => 2025, 'tingkat' => 'Kecamatan', 'ket' => 'Lomba Futsal Putra']
];
$guru = [ //  45]
    ['nama' => 'Jajang Rahmat M, M.Pd', 'jabatan' => 'Kepala Madrasah'],
    ['nama' => 'Muhammad Ridal Al-kautsar, S.Pd', 'jabatan' => 'Guru Mapel'],
    ['nama' => 'U.Nurdin, S.Pd.I', 'jabatan' => 'Guru Mapel'],
    ['nama' => 'Edi Mulyadi, S.Pd', 'jabatan' => 'Guru Mapel & Guru Ngaji'],
    ['nama' => 'Maryatinah, S.Pd', 'jabatan' => 'Guru Mapel, Walikelas 9B'],
    ['nama' => 'Endang Kurniawan, S.Pd', 'jabatan' => 'Guru Mapel, Wali kelas 8'],
    ['nama' => 'Gina Mulyana, S.Pd', 'jabatan' => 'Guru Mapel'],
    ['nama' => 'Ika Febrianti, S.Pd', 'jabatan' => 'Guru Mapel'],
    ['nama' => 'Nenti Saripah, S.Pd.I', 'jabatan' => 'Guru Mapel'],
    ['nama' => 'M. Ridho Bilhaq, S.Pd', 'jabatan' => 'Guru Mapel'],
    ['nama' => 'Edi Mulyadi, M.Pd', 'jabatan' => 'Guru Mapel'],
    ['nama' => 'Siti Suryani, S.H.I', 'jabatan' => 'Guru Mapel'],
    ['nama' => 'Gilang Nanda Hermawan, S.H', 'jabatan' => 'Guru Mapel'],
    ['nama' => 'Deuis Solehah, S.Pd', 'jabatan' => 'Guru Mapel'],
    ['nama' => 'Deni Purnadi bakti, A.Md.Kom', 'jabatan' => 'Operator, Guru Mapel'],
    ['nama' => 'Rukman Nurhakim, S.IP', 'jabatan' => 'Guru Mapel'],
    ['nama' => 'Akhyar Fauzi, S.AP', 'jabatan' => 'Staf, Ben. Infak, Guru Ngaji'],
    ['nama' => 'Irham Maulana', 'jabatan' => 'Guru Piket'],
    ['nama' => 'Sihabudin, S.Pd', 'jabatan' => 'Guru Mapel'],
    ['nama' => 'Abdul Aziz', 'jabatan' => 'Guru Ngaji'],
    ['nama' => 'Siti Imas Masyitoh', 'jabatan' => 'Guru Mapel, Guru Piket'],
];
$koordinat = "-6.9045966,106.9387926,20.25"; // 
$googleMapsLink = "https://www.google.com/maps/place/Mts+Cisarua+Girang/@-6.9045966,106.9387926,20.25z/data=!4m12!1m5!3m4!2zNsKwNTQnMTYuMiJTIDEwNsKwNTYnMjAuNiJF!8m2!3d-6.904504!4d106.939053!3m5!1s0x2e68497172df74d3:0x328210d6fa228ca0!8m2!3d-6.9046277!4d106.939088!16s%2Fg%2F11td402yrp?entry=ttu&g_ep=EgoyMDI1MTAxNC4wIKXMDSoASAFQAw%3D%3D" . urlencode($koordinat);

?>

<div class="position-relative" style="height: 90vh;">

    <div id="backgroundCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;">
        <div class="carousel-inner h-100">
            <div class="carousel-item active h-100">
                <img src="<?= base_url('assets/img/foto-sekolah.jpg') ?>" class="d-block w-100 h-100" alt="Suasana Sekolah 1" style="object-fit: cover;">
            </div>
            <div class="carousel-item h-100">
                <img src="<?= base_url('assets/img/foto-sekolah2.jpg') ?>" class="d-block w-100 h-100" alt="Kegiatan Belajar" style="object-fit: cover;">
            </div>
            <div class="carousel-item h-100">
                <img src="<?= base_url('assets/img/Sekolah2.jpg') ?>" class="d-block w-100 h-100" alt="Prestasi Siswa" style="object-fit: cover;">
            </div>
        </div>
    </div>

    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center" style="z-index: 2; background-color: rgba(0, 0, 0, 0.5);">
        <div class="text-center text-white p-4 rounded">
            <h1 class="display-4 fw-bold">Selamat Datang di PPDB Online</h1>
            <h2 class="fs-3">MTs Cisarua Girang</h2>
            <p class="lead mt-3">Mewujudkan Generasi Cerdas, Berakhlak, dan Berprestasi.</p>
            <a href="<?= $linkTombol ?>" class="btn btn-primary btn-lg mt-3"><?= $teksTombol ?></a>
        </div>
    </div>

</div>

<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Profil Madrasah</h2>
        <div class="row g-4 align-items-center">
            <div class="col-md-6">
                <h4>MTs Cisarua Girang</h4>
                <p>
                    <span class="badge bg-success">NSM: 121232020268</span>  
                    <span class="badge bg-info">NPSN: 69928082</span>  
                    <span class="badge bg-warning text-dark">Akreditasi: B</span>  
                </p>
                <p><i class="bi bi-geo-alt-fill me-2"></i><strong>Alamat:</strong><br> <?= esc("Jl. Selabintana No. 02, Babakan Kiara RT 23 RW 09, Desa Sukajaya, Kec. Sukabumi, Kab. Sukabumi 43151") ?>  </p>
                <p><i class="bi bi-building me-2"></i><strong>Di bawah naungan:</strong><br> Yayasan Pendidikan Islam Darul Muta’Allimin Al Islamiyah  </p>
                <p><i class="bi bi-envelope-fill me-2"></i><strong>Email:</strong> <?= esc("mtscisaruagirang@yahoo.com") ?>  </p>
                <a href="<?= $googleMapsLink ?>" target="_blank" class="btn btn-outline-primary mt-2"><i class="bi bi-map-fill me-2"></i> Lihat Peta Lokasi</a>
            </div>
            <div class="col-md-6">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.166881267876!2d<?= explode(',', $koordinat)[1] ?>!3d<?= explode(',', $koordinat)[0] ?>!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwNTQnMTYuMiJTIDEwNsKwNTYnMjAuNiJF!5e0!3m2!1sen!2sid!4v1678886400000!5m2!1sen!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Visi, Misi & Tujuan</h2>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary"><i class="bi bi-bullseye me-2"></i>Visi</h5>
                        <p class="card-text fst-italic">"<?= esc($visi) ?>"</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                 <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title text-success"><i class="bi bi-list-check me-2"></i>Misi</h5>
                        <ul class="list-unstyled">
                            <?php foreach ($misi as $item): ?>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i><?= esc($item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
             <div class="col-lg-6">
                 <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title text-info"><i class="bi bi-flag-fill me-2"></i>Tujuan</h5>
                         <ul class="list-unstyled">
                            <?php foreach ($tujuan as $item): ?>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-info me-2"></i><?= esc($item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Target Lulusan</h2>
         <div class="row justify-content-center">
             <div class="col-lg-8">
                 <ul class="list-group list-group-flush">
                     <?php foreach ($targetLulusan as $target): ?>
                         <li class="list-group-item d-flex align-items-center">
                             <i class="bi bi-mortarboard-fill text-primary me-3 fs-4"></i>
                             <?= esc($target) ?>
                         </li>
                     <?php endforeach; ?>
                 </ul>
             </div>
         </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Prestasi</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 justify-content-center">
            <?php foreach ($prestasi as $p): ?>
            <div class="col">
                <div class="card h-100 shadow-sm card-hover-effect"> 
                    <img src="https://placehold.co/400x250/EFEFEF/AAAAAA&text=Foto+Prestasi" class="card-img-top" alt="Foto <?= esc($p['jenis']) ?>">
                    <div class="card-body text-center">
                        <h6 class="card-title fw-bold"><?= esc($p['jenis']) ?></h6>
                        <p class="card-text small text-muted">
                            Tahun <?= esc($p['tahun']) ?> - Tingkat <?= esc($p['tingkat']) ?>
                            <br>
                            <span class="fst-italic">"<?= esc($p['ket']) ?>"</span>
                        </p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
    </div>

<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Guru & Tenaga Kependidikan</h2>

        <div id="guruCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                <?php
                // Grup guru menjadi array per 3 orang
                $guruChunks = array_chunk($guru, 3); // Ganti angka 4 jadi 3
                $first = true; // Flag untuk item pertama
                ?>

                <?php foreach ($guruChunks as $chunk): ?>
                <div class="carousel-item <?= $first ? 'active' : '' ?>">
                   
                    <div class="row g-4 justify-content-center">
                        <?php foreach ($chunk as $g): ?>
                        
                        <div class="col-lg-3 col-md-4 col-sm-6 col-10"> 
                            <div class="card h-100 text-center shadow-sm">
                                <img src="https://placehold.co/300x300/EFEFEF/AAAAAA&text=Foto" class="card-img-top" alt="Foto <?= esc($g['nama']) ?>">
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title fw-bold mt-auto"><?= esc($g['nama']) ?></h6>
                                    <p class="card-text small text-muted mb-0"><?= esc($g['jabatan']) ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div> 
                <?php $first = false; ?>
                <?php endforeach; ?>

            </div> 
            <button class="carousel-control-prev" type="button" data-bs-target="#guruCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(1) grayscale(100);"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#guruCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(1) grayscale(100);"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </div> 
</section>

<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Persyaratan Administrasi PPDB</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="alert alert-info d-flex align-items-center" role="alert">
                     <i class="bi bi-info-circle-fill me-3 fs-4"></i>
                     <div>
                         Berikut adalah dokumen yang perlu disiapkan untuk pendaftaran (beberapa diupload melalui form online, sisanya dibawa saat verifikasi):
                     </div>
                </div>

                <ul class="list-group list-group-flush shadow-sm">
                    <li class="list-group-item"><i class="bi bi-file-earmark-check-fill text-success me-2"></i> Mengisi Formulir Pendaftaran</li>
                    <li class="list-group-item"><i class="bi bi-file-earmark-check-fill text-success me-2"></i> Surat Keterangan Lulus dari Sekolah (SD/MI) asal</li>
                    <li class="list-group-item"><i class="bi bi-person-badge-fill text-primary me-2"></i> Kartu Keluarga (KK) <!--<span class="badge bg-primary ms-1">Upload Online (Opsional)</span> --></li>
                    <li class="list-group-item"><i class="bi bi-card-heading text-primary me-2"></i> Akta Kelahiran <!-- <span class="badge bg-primary ms-1">Upload Online</span> --> </li>
                    <li class="list-group-item"><i class="bi bi-person-vcard-fill text-primary me-2"></i> KTP Orang Tua <!-- <span class="badge bg-primary ms-1">Upload Online</span> --></li>
                    <!-- <li class="list-group-item"><i class="bi bi-person-vcard-fill text-primary me-2"></i> Fotokopi KTP Ibu <span class="badge bg-primary ms-1">Upload Online</span></li> -->
                    <!-- <li class="list-group-item"><i class="bi bi-award-fill text-warning me-2"></i> Fotokopi Kartu KIP/KIS/PKH (Jika Ada) <span class="badge bg-primary ms-1">Upload Online</span></li> -->
                    <li class="list-group-item"><i class="bi bi-image-fill text-info me-2"></i> Pas Foto 3x4 <!-- <span class="badge bg-primary ms-1">Upload Online</span> --></li>
                    <li class="list-group-item"><i class="bi bi-file-earmark-ruled-fill text-secondary me-2"></i> Surat Keterangan Kelakuan Baik (SKKB) dari sekolah asal <!-- <span class="badge bg-primary ms-1">Upload Online</span> --></li>
                </ul>
                <p class="mt-3 text-muted small">* Dokumen asli harap dibawa saat melakukan verifikasi data ke madrasah.</p>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>