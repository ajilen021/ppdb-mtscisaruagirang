<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran - <?= esc($pendaftar['nama_lengkap']) ?></title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11pt; line-height: 1.4; color: #333; }
        .container { width: 90%; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; position: relative; }
        .header img { position: absolute; left: 0; top: 0; width: 60px; height: auto; } /* Adjust size as needed */
        .header h3, .header h4 { margin: 0; padding: 0; }
        .header p { margin: 2px 0; font-size: 9pt; }
        .title { text-align: center; margin-bottom: 25px; font-weight: bold; font-size: 14pt; text-decoration: underline; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { text-align: left; padding: 6px; vertical-align: top; }
        th { width: 180px; font-weight: normal;}
        .section-title { font-weight: bold; margin-top: 20px; margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 5px; font-size: 12pt;}
        .status-box { padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px; }
        .status-box strong { display: block; margin-bottom: 5px; }
        .status-diterima { background-color: #d4edda; border-color: #c3e6cb; color: #155724; }
        .status-ditolak { background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; }
        .status-menunggu { background-color: #fff3cd; border-color: #ffeeba; color: #856404; }
        .small-text { font-size: 9pt; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
             <img src="<?= $logoPath ?>" alt="Logo Sekolah"> <!-- Logo from Controller -->
             <h4>YAYASAN PENDIDIKAN DARUL MUTA’ALLIMIN AL ISLAMIYAH</h4>
             <h3>MADRASAH TSANAWIYAH (MTS) CISARUA GIRANG</h3>
             <p>Jl. Selabintana No. 02, Babakan Kiara RT 23 RW 09, Desa Sukajaya, Kec. Sukabumi, Kab. Sukabumi 43151</p>
             <p>Email: mtscisaruagirang@yahoo.com | NSM: 121232020268 | NPSN: 69928082 | Terakreditasi "B"</p>
        </div>

        <div class="title">BUKTI PENDAFTARAN SISWA BARU</div>

         <!-- Status Pendaftaran & Alasan -->
        <?php
        $status = $pendaftar['status'] ?? 'Menunggu Konfirmasi';
        $alasan = $pendaftar['alasan_penolakan'] ?? null;
        $statusClass = 'status-menunggu'; // Default
        if ($status === 'Diterima') {
            $statusClass = 'status-diterima';
        } elseif ($status === 'Ditolak') {
            $statusClass = 'status-ditolak';
        }
        ?>
        <div class="status-box <?= $statusClass ?>">
            <strong>Status Pendaftaran: <?= esc($status) ?></strong>
            <?php if ($status === 'Ditolak'): ?>
                <?php if (!empty($alasan)): ?>
                    <span>Alasan: <?= esc($alasan) ?></span>
                <?php else: ?>
                    <span class="small-text">Tidak ada alasan spesifik yang diberikan.</span>
                 <?php endif; ?>
            <?php endif; ?>
        </div>


        <div class="section-title">A. Data Calon Siswa</div>
        <table>
            <tr><th>Nama Lengkap</th><td>:</td><td><?= esc($pendaftar['nama_lengkap']) ?></td></tr>
            <tr><th>Nama Panggilan</th><td>:</td><td><?= esc($pendaftar['nama_panggilan'] ?: '-') ?></td></tr>
            <tr><th>Tempat, Tanggal Lahir</th><td>:</td><td><?= esc($pendaftar['tempat_lahir']) ?>, <?= date('d F Y', strtotime($pendaftar['tanggal_lahir'])) ?></td></tr>
            <tr><th>Agama</th><td>:</td><td><?= esc($pendaftar['agama'] ?: '-') ?></td></tr>
            <tr><th>Kewarganegaraan</th><td>:</td><td><?= esc($pendaftar['kewarganegaraan'] ?: '-') ?></td></tr>
            <tr><th>Anak Ke-</th><td>:</td><td><?= esc($pendaftar['anak_ke'] ?: '-') ?></td></tr>
            <tr><th>Jumlah Saudara</th><td>:</td><td>Kakak: <?= esc($pendaftar['jumlah_kakak'] ?? '-') ?>, Adik: <?= esc($pendaftar['jumlah_adik'] ?? '-') ?></td></tr>
            <tr><th>Jenis Kelamin</th><td>:</td><td><?= esc($pendaftar['jenis_kelamin']) ?></td></tr>
            <tr><th>Alamat Siswa</th><td>:</td><td><?= esc($pendaftar['alamat']) ?></td></tr>
            <tr><th>Tinggal Bersama</th><td>:</td><td><?= esc($pendaftar['tinggal_bersama'] ?: '-') ?></td></tr>
            <tr><th>Asal Sekolah (SD/MI)</th><td>:</td><td><?= esc($pendaftar['asal_sekolah']) ?></td></tr>
             <tr><th>Status Masuk</th><td>:</td><td><?= esc($pendaftar['status_masuk']) ?></td></tr>
            <?php if ($pendaftar['status_masuk'] === 'Pindahan'): ?>
                <tr><th>Diterima di Kelas</th><td>:</td><td><?= esc($pendaftar['diterima_kelas'] ?: '-') ?></td></tr>
                <tr><th>Tanggal Diterima</th><td>:</td><td><?= $pendaftar['tanggal_diterima'] ? date('d F Y', strtotime($pendaftar['tanggal_diterima'])) : '-' ?></td></tr>
            <?php endif; ?>
            <tr><th>Nomor HP/WA Orang Tua</th><td>:</td><td><?= esc($pendaftar['no_hp']) ?></td></tr>
        </table>

        <div class="section-title">B. Data Orang Tua</div>
        <table>
            <tr><th>Nama Ayah</th><td>:</td><td><?= esc($pendaftar['nama_ayah']) ?></td></tr>
            <tr><th>Pekerjaan Ayah</th><td>:</td><td><?= esc($pendaftar['pekerjaan_ayah']) ?></td></tr>
            <tr><th>Nama Ibu</th><td>:</td><td><?= esc($pendaftar['nama_ibu']) ?></td></tr>
            <tr><th>Pekerjaan Ibu</th><td>:</td><td><?= esc($pendaftar['pekerjaan_ibu']) ?></td></tr>
            <tr><th>Alamat</th><td>:</td><td><?= esc($pendaftar['alamat_ortu'] ?: '-') ?></td></tr>
            <tr><th>Nomor HP</th><td>:</td><td><?= esc($pendaftar['no_hp_ortu'] ?: '-') ?></td></tr>
        </table>

        <div class="section-title">C. Data Wali (Jika Ada)</div>
        <table>
             <tr><th>Nama Wali</th><td>:</td><td><?= esc($pendaftar['nama_wali'] ?: '-') ?></td></tr>
             <tr><th>Alamat Wali</th><td>:</td><td><?= esc($pendaftar['alamat_wali'] ?: '-') ?></td></tr>
        </table>

        <div class="section-title">D. Data Kependudukan</div>
         <table>
            <tr><th>Nomor KK</th><td>:</td><td><?= esc($pendaftar['no_kk']) ?></td></tr>
        </table>

        <div class="section-title">E. Dokumen Terlampir</div>
         <table>
             <tr><th>Pas Foto 3x4</th><td>:</td><td><?= $pendaftar['foto_path'] ? 'Terlampir' : '<span class="small-text">Tidak diupload</span>' ?></td></tr>
             <tr><th>SKL</th><td>:</td><td><?= $pendaftar['skl_path'] ? 'Terlampir' : '<span style="color:red;">Wajib Dilampirkan</span>' ?></td></tr>
             <tr><th>KTP Ayah</th><td>:</td><td><?= $pendaftar['ktp_ayah_path'] ? 'Terlampir' : '<span style="color:red;">Wajib Dilampirkan</span>' ?></td></tr>
             <tr><th>KTP Ibu</th><td>:</td><td><?= $pendaftar['ktp_ibu_path'] ? 'Terlampir' : '<span style="color:red;">Wajib Dilampirkan</span>' ?></td></tr>
             <tr><th>Akta Kelahiran</th><td>:</td><td><?= $pendaftar['akta_path'] ? 'Terlampir' : '<span style="color:red;">Wajib Dilampirkan</span>' ?></td></tr>
             <tr><th>SKKB</th><td>:</td><td><?= $pendaftar['skkb_path'] ? 'Terlampir' : '<span style="color:red;">Wajib Dilampirkan</span>' ?></td></tr>
             <tr><th>Kartu Keluarga (KK)</th><td>:</td><td><?= $pendaftar['kk_path'] ? 'Terlampir' : '<span class="small-text">Tidak diupload</span>' ?></td></tr>
        </table>

    </div>
</body>
</html>

