<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PendaftarModel; // <-- 1. Panggil PendaftarModel

class Dashboard extends BaseController
{
    public function index()
    {
        // 2. Buat instance model
        $pendaftarModel = new PendaftarModel();

        // 3. Ambil data statistik (INI YANG SUDAH ADA)
        $totalPendaftar = $pendaftarModel->countAllResults();
        $totalMenunggu  = $pendaftarModel->where('status', 'Menunggu Konfirmasi')->countAllResults();
        $totalDiterima  = $pendaftarModel->where('status', 'Diterima')->countAllResults();
        $totalDitolak   = $pendaftarModel->where('status', 'Ditolak')->countAllResults();

        // --- TAMBAHAN BARU (SESUAI REQUEST) ---

        // 4. Data untuk Target (Request 2)
        $totalLaki = $pendaftarModel->where('jenis_kelamin', 'Laki-laki')->countAllResults();
        $totalPerempuan = $pendaftarModel->where('jenis_kelamin', 'Perempuan')->countAllResults();

        // 5. Data untuk Pendaftar Terbaru (Request 3 - Saran gw 5 terakhir)
        $pendaftarTerbaru = $pendaftarModel->orderBy('created_at', 'DESC')
                                          ->limit(5)
                                          ->find();

        // 6. Data untuk Grafik 7 Hari Terakhir (Request 1 - Saran gw)
        $chartLabels = [];
        $chartDataLaki = [];
        $chartDataPerempuan = [];

        // Loop dari 6 hari lalu (i=6) sampai hari ini (i=0)
        for ($i = 6; $i >= 0; $i--) {
            $tanggal = date('Y-m-d', strtotime("-$i days"));
            $labels = date('d M', strtotime($tanggal)); // Format '22 Okt'

            // Query data Laki-laki pada tanggal tsb
            $countLaki = $pendaftarModel->where('jenis_kelamin', 'Laki-laki')
                                      ->where('DATE(created_at)', $tanggal)
                                      ->countAllResults();

            // Query data Perempuan pada tanggal tsb
            $countPerempuan = $pendaftarModel->where('jenis_kelamin', 'Perempuan')
                                           ->where('DATE(created_at)', $tanggal)
                                           ->countAllResults();

            $chartLabels[] = $labels;
            $chartDataLaki[] = $countLaki;
            $chartDataPerempuan[] = $countPerempuan;
        }

        // --- AKHIR TAMBAHAN BARU ---


        $data = [
            'title'          => 'Admin Dashboard',
            'totalPendaftar' => $totalPendaftar,
            'totalMenunggu'  => $totalMenunggu,
            'totalDiterima'  => $totalDiterima,
            'totalDitolak'   => $totalDitolak,
            // Kirim data baru ke view
            'totalLaki'        => $totalLaki,
            'totalPerempuan'   => $totalPerempuan,
            'pendaftarTerbaru' => $pendaftarTerbaru,
            'chartLabels'      => json_encode($chartLabels), // Kirim sbg JSON string
            'chartDataLaki'    => json_encode($chartDataLaki), // Kirim sbg JSON string
            'chartDataPerempuan' => json_encode($chartDataPerempuan), // Kirim sbg JSON string
        ];

        // 4. Kirim data ke view
        return view('admin/dashboard', $data);
    }
}