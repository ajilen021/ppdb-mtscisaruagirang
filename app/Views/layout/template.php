<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'PPDB MTs Cisarua Girang'); ?> | PPDB MTs Cisarua Girang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'PPDB MTs Cisarua Girang'); ?> | PPDB MTs Cisarua Girang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">

    <style>
        main {
            min-height: 75vh; /* Memastikan konten mengisi ruang, footer tidak naik */
        }
    </style>
</head>

    <!-- CSS Custom Anda jika ada -->
    <style>
        main {
            min-height: 75vh; /* Memastikan konten mengisi ruang, footer tidak naik */
        }
        /* Anda bisa menambahkan style custom di sini jika perlu */
        main {
            min-height: 75vh; /* Memastikan konten mengisi ruang, footer tidak naik */
        }
        
        /* FIX UNTUK MODAL SCROLL */
        .modal-dialog.modal-lg.modal-dialog-scrollable .modal-body {
            /* Atur tinggi maksimal agar modal-body bisa di-scroll */
            max-height: 70vh; 
            overflow-y: auto; 
        }
        /* End FIX MODAL SCROLL */
        
    </style>
    </style>
</head>
<body>

    <!-- Memasukkan Header -->
    <?= $this->include('layout/header'); ?>

    <main>
        <!-- =================================================================
        BAGIAN UNTUK MENAMPILKAN PESAN ALERT (ERROR ATAU SUKSES)
        ================================================================== -->
        <div class="container pt-3">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>
        <!-- =================================================================
        AKHIR BAGIAN ALERT
        ================================================================== -->

        <!-- Konten Halaman Dinamis -->
        <?= $this->renderSection('content'); ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- {/* ... (Script Bootstrap, dll) ... */} -->

    <!-- {/* ===== Scroll Navigation Arrows START ===== */} -->
    <a href="#top" id="scrollTopBtn" class="scroll-btn" title="Go to top">
        <i class="bi bi-arrow-up-circle-fill"></i>
    </a>
    <a href="#bottom" id="scrollBottomBtn" class="scroll-btn" title="Go to bottom">
        <i class="bi bi-arrow-down-circle-fill"></i>
    </a>
    <!-- {/* ===== Scroll Navigation Arrows END ===== */} -->

    <!-- {/* (Anchor point untuk scroll bottom, taruh sebelum footer) */} -->
    <div id="bottom"></div>
    <?= $this->include('layout/footer'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- {/* ... (JavaScript Dark Mode) ... */} -->

    <!-- {/* ===== JavaScript untuk Scroll Buttons START ===== */} -->
    <script>
        const scrollTopBtn = document.getElementById('scrollTopBtn');
        const scrollBottomBtn = document.getElementById('scrollBottomBtn');
        const scrollThreshold = 200; // Jarak scroll (pixel) sebelum tombol muncul

        // Fungsi untuk smooth scroll (jika browser tidak support scroll-behavior: smooth)
        function smoothScroll(targetId) {
            const targetElement = document.getElementById(targetId === '#top' ? 'top-anchor' : 'bottom'); // top-anchor perlu ditambah di body
            if (targetElement) {
                window.scrollTo({
                    top: targetId === '#top' ? 0 : targetElement.offsetTop,
                    behavior: 'smooth'
                });
            }
             // Tambahkan anchor di body paling atas jika belum ada
             if (!document.getElementById('top-anchor') && targetId === '#top') {
                 const topAnchor = document.createElement('div');
                 topAnchor.id = 'top-anchor';
                 document.body.prepend(topAnchor);
             }
        }

        // Tampilkan/sembunyikan tombol saat scroll
        window.onscroll = function() {
            let scrollPos = document.documentElement.scrollTop || document.body.scrollTop;
            let windowHeight = window.innerHeight;
            let docHeight = document.documentElement.scrollHeight;

            // Tombol Atas
            if (scrollPos > scrollThreshold) {
                scrollTopBtn.style.display = "block";
            } else {
                scrollTopBtn.style.display = "none";
            }

            // Tombol Bawah
            // Muncul jika belum sampai bawah (misal, jarak dari bawah > threshold)
            if (docHeight - (scrollPos + windowHeight) > scrollThreshold) {
                scrollBottomBtn.style.display = "block";
            } else {
                scrollBottomBtn.style.display = "none";
            }
        };

         // Tambahkan event listener ke tombol untuk smooth scroll
         scrollTopBtn.addEventListener('click', function(e) {
             e.preventDefault();
             smoothScroll('#top');
         });
         scrollBottomBtn.addEventListener('click', function(e) {
             e.preventDefault();
             smoothScroll('#bottom');
         });

    </script>
    <!-- {/* ===== JavaScript untuk Scroll Buttons END ===== */} -->
</body>
</html>

