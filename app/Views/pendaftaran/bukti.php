<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container mt-5 mb-5">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Bukti Pendaftaran - <?= esc($pendaftar['nama_lengkap']) ?></h4>
            <div>
                 <a href="<?= base_url('/pendaftaran/downloadPDF') ?>" class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i> Download PDF</a>
                 <button onclick="window.print()" class="btn btn-secondary btn-sm"><i class="fas fa-print"></i> Cetak</button>
            </div>
        </div>
        <div class="card-body">

            <!-- ============================================== -->
            <!--        BAGIAN STATUS YANG DIPERBARUI         -->
            <!-- ============================================== -->
            <?php
            $status = $pendaftar['status'] ?? 'Menunggu Konfirmasi';
            $alasan = $pendaftar['alasan_penolakan'] ?? null; // Ambil alasan
            $alertClass = 'alert-warning'; // Default untuk Menunggu
            $statusText = 'Menunggu Konfirmasi';

            if ($status === 'Diterima') {
                $alertClass = 'alert-success';
                $statusText = 'Diterima';
            } elseif ($status === 'Ditolak') {
                $alertClass = 'alert-danger';
                $statusText = 'Ditolak';
            }
            ?>
            <div class="alert <?= $alertClass ?>" role="alert">
                <h5 class="alert-heading">Status Pendaftaran: <?= esc($statusText) ?></h5>

                <?php if ($status === 'Diterima') : ?>
                    <p>Selamat! Pendaftaran Anda telah diterima. Silakan tunggu informasi selanjutnya dari panitia PPDB.</p>

                <?php elseif ($status === 'Ditolak') : ?>
                    <p>Mohon maaf, pendaftaran Anda ditolak.</p>

                    <?php if (!empty($alasan)) : ?>
                        <hr>
                        <p class="mb-0"><strong>Alasan:</strong> <?= esc($alasan) ?></p>
                    <?php else : ?>
                         <hr>
                         <p class="mb-0"><em>Tidak ada alasan spesifik yang diberikan oleh admin.</em></p>
                    <?php endif; ?>
                    
                    <hr>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal"><i class="bi bi-pencil-square me-2"></i> Perbarui Data & Ajukan Ulang</button>

                <?php else : // Status Menunggu Konfirmasi ?>
                    <p>Data pendaftaran Anda telah kami terima. Silakan hubungi panitia PPDB dalam 1x24 jam untuk konfirmasi atau tunggu status pendaftaran Anda diperbarui.</p>
                <?php endif; ?>
            </div>
             <!-- ============================================== -->
             <!--         AKHIR BAGIAN STATUS                  -->
             <!-- ============================================== -->


            <h5 class="mt-4">Data Pendaftar</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr><th style="width: 200px;">Nama Lengkap</th><td><?= esc($pendaftar['nama_lengkap']) ?></td></tr>
                        <tr><th>Nama Panggilan</th><td><?= esc($pendaftar['nama_panggilan'] ?? '-') ?></td></tr>
                        <tr><th>Tempat, Tanggal Lahir</th><td><?= esc($pendaftar['tempat_lahir']) ?>, <?= date('d F Y', strtotime($pendaftar['tanggal_lahir'])) ?></td></tr>
                        <tr><th>Agama</th><td><?= esc($pendaftar['agama'] ?? '-') ?></td></tr>
                        <tr><th>Kewarganegaraan</th><td><?= esc($pendaftar['kewarganegaraan'] ?? '-') ?></td></tr>
                        <tr><th>Anak Ke-</th><td><?= esc($pendaftar['anak_ke'] ?? '-') ?></td></tr>
                        <tr><th>Jumlah Saudara</th><td>Kakak: <?= esc($pendaftar['jumlah_kakak'] ?? '-') ?>, Adik: <?= esc($pendaftar['jumlah_adik'] ?? '-') ?></td></tr>
                        <tr><th>Jenis Kelamin</th><td><?= esc($pendaftar['jenis_kelamin']) ?></td></tr>
                        <tr><th>Alamat Siswa</th><td><?= esc($pendaftar['alamat']) ?></td></tr>
                         <tr><th>Tinggal Bersama</th><td><?= esc($pendaftar['tinggal_bersama'] ?? '-') ?></td></tr>
                         <tr><th>Nomor HP Siswa</th><td><?= esc($pendaftar['no_hp']) ?></td></tr>
                         <tr><th>NIK Siswa</th><td><?= esc($pendaftar['nik']) ?></td></tr>
                         <tr><th>Nomor KK</th><td><?= esc($pendaftar['no_kk']) ?></td></tr>
                    </tbody>
                </table>
            </div>

            <h5 class="mt-4">Data Sekolah Asal</h5>
             <div class="table-responsive">
                <table class="table table-bordered table-striped">
                     <tbody>
                        <tr><th style="width: 200px;">Nama Asal Sekolah</th><td><?= esc($pendaftar['asal_sekolah']) ?></td></tr>
                        <tr><th>Status Masuk</th><td><?= esc($pendaftar['status_masuk'] ?? 'Siswa Baru') ?></td></tr>
                         <?php if (!empty($pendaftar['status_masuk']) && $pendaftar['status_masuk'] === 'Pindahan'): ?>
                             <tr><th>Diterima di Kelas</th><td><?= esc($pendaftar['diterima_kelas'] ?? '-') ?></td></tr>
                             <tr><th>Tanggal Diterima</th><td><?= $pendaftar['tanggal_diterima'] ? date('d F Y', strtotime($pendaftar['tanggal_diterima'])) : '-' ?></td></tr>
                         <?php endif; ?>
                    </tbody>
                </table>
            </div>

             <h5 class="mt-4">Data Orang Tua / Wali</h5>
             <div class="table-responsive">
                <table class="table table-bordered table-striped">
                     <tbody>
                        <tr><th style="width: 200px;">Nama Ayah</th><td><?= esc($pendaftar['nama_ayah']) ?></td></tr>
                        <tr><th>Pekerjaan Ayah</th><td><?= esc($pendaftar['pekerjaan_ayah']) ?></td></tr>
                        <tr><th>Nama Ibu</th><td><?= esc($pendaftar['nama_ibu']) ?></td></tr>
                        <tr><th>Pekerjaan Ibu</th><td><?= esc($pendaftar['pekerjaan_ibu']) ?></td></tr>
                        <tr><th>Alamat </th><td><?= esc($pendaftar['alamat_ortu'] ?? '-') ?></td></tr>
                        <tr><th>No. HP </th><td><?= esc($pendaftar['no_hp_ortu'] ?? '-') ?></td></tr>
                         <tr><td colspan="2"> </td></tr> <!-- Separator -->
                         <tr><th>Nama Wali</th><td><?= esc($pendaftar['nama_wali'] ?? '-') ?></td></tr>
                         <tr><th>Alamat Wali</th><td><?= esc($pendaftar['alamat_wali'] ?? '-') ?></td></tr>
                    </tbody>
                </table>
            </div>


            <h5 class="mt-4">Dokumen Terlampir</h5>
            <ul>
                <li>Foto 3x4: <?= $pendaftar['foto_path'] ? '<a href="'.base_url('uploads/foto/'.$pendaftar['foto_path']).'" target="_blank">Lihat</a>' : 'Tidak diupload' ?></li>
                <li>Dokumen SKL: <?= $pendaftar['skl_path'] ? '<a href="'.base_url('uploads/dokumen/'.$pendaftar['skl_path']).'" target="_blank">Lihat</a>' : '<span class="text-danger">Wajib Diupload</span>' ?></li>
                <li>Dokumen KTP Orang Tua: <?= $pendaftar['ktp_ayah_path'] ? '<a href="'.base_url('uploads/dokumen/'.$pendaftar['ktp_ayah_path']).'" target="_blank">Lihat</a>' : '<span class="text-danger">Wajib Diupload</span>' ?></li>
                <li>Dokumen Akta Kelahiran: <?= $pendaftar['akta_path'] ? '<a href="'.base_url('uploads/dokumen/'.$pendaftar['akta_path']).'" target="_blank">Lihat</a>' : '<span class="text-danger">Wajib Diupload</span>' ?></li>
                <li>Dokumen SKKB: <?= $pendaftar['skkb_path'] ? '<a href="'.base_url('uploads/dokumen/'.$pendaftar['skkb_path']).'" target="_blank">Lihat</a>' : '<span class="text-danger">Wajib Diupload</span>' ?></li>
                <li>Dokumen KK: <?= $pendaftar['kk_path'] ? '<a href="'.base_url('uploads/dokumen/'.$pendaftar['kk_path']).'" target="_blank">Lihat</a>' : '<span class="text-danger">Wajib Diupload</span>' ?></li>
            </ul>

        </div>
    </div>
</div>
// Views/pendaftaran/bukti.php (Setelah konten utama, sebelum endSection)

<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable"> 
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Perbarui Data Pendaftaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('/pendaftaran/update') ?>" method="post" enctype="multipart/form-data">
      <div class="modal-body">
            <?= csrf_field() ?>
            <p class="text-danger small">Hanya data tertentu yang dapat diubah. Setelah diperbarui, status Anda akan direset menjadi "Menunggu Konfirmasi".</p>
            
            <h5 class="mt-4 mb-3 border-bottom pb-2">A. Data Calon Siswa</h5>

            <div class="row mb-3">
                <div class="col-md-8">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= old('nama_lengkap', $pendaftar['nama_lengkap']) ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="nama_panggilan" class="form-label">Nama Panggilan</label>
                    <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan" value="<?= old('nama_panggilan', $pendaftar['nama_panggilan']) ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= old('tempat_lahir', $pendaftar['tempat_lahir']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= old('tanggal_lahir', $pendaftar['tanggal_lahir']) ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                 <div class="col-md-4">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="Laki-laki" <?= old('jenis_kelamin', $pendaftar['jenis_kelamin']) == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="Perempuan" <?= old('jenis_kelamin', $pendaftar['jenis_kelamin']) == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>
                 <div class="col-md-8">
                    <label for="asal_sekolah" class="form-label">Nama Asal Sekolah (SD/MI) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="<?= old('asal_sekolah', $pendaftar['asal_sekolah']) ?>" required>
                </div>
            </div>

             <div class="row mb-3">
                 <div class="col-md-8">
                    <label for="alamat" class="form-label">Alamat Lengkap Siswa <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= old('alamat', $pendaftar['alamat']) ?></textarea>
                </div>
                <div class="col-md-4">
                    <label for="tinggal_bersama" class="form-label">Tinggal Bersama <span class="text-danger">*</span></label>
                    <select class="form-select" id="tinggal_bersama" name="tinggal_bersama" required>
                        <option value="Orang Tua" <?= old('tinggal_bersama', $pendaftar['tinggal_bersama']) == 'Orang Tua' ? 'selected' : '' ?>>Orang Tua</option>
                        <option value="Saudara" <?= old('tinggal_bersama', $pendaftar['tinggal_bersama']) == 'Saudara' ? 'selected' : '' ?>>Saudara</option>
                        <option value="Kost" <?= old('tinggal_bersama', $pendaftar['tinggal_bersama']) == 'Kost' ? 'selected' : '' ?>>Kost</option>
                        <option value="Asrama" <?= old('tinggal_bersama', $pendaftar['tinggal_bersama']) == 'Asrama' ? 'selected' : '' ?>>Asrama</option>
                        <option value="Lainnya" <?= old('tinggal_bersama', $pendaftar['tinggal_bersama']) == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                    </select>
                </div>
             </div>

             <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nik" class="form-label">NIK Siswa (Sesuai KK) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nik" name="nik" value="<?= old('nik', $pendaftar['nik']) ?>" maxlength="16" required>
                </div>
                <div class="col-md-6">
                    <label for="no_kk" class="form-label">Nomor Kartu Keluarga (KK) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="no_kk" name="no_kk" value="<?= old('no_kk', $pendaftar['no_kk']) ?>" maxlength="16" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="no_hp" class="form-label">Nomor HP/WA Orang Tua (Aktif) <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control" id="no_hp" name="no_hp" value="<?= old('no_hp', $pendaftar['no_hp']) ?>" placeholder="Contoh: 081234567890" required>
                </div>
            </div>

            <h5 class="mt-5 mb-3 border-bottom pb-2">B. Update Dokumen (Hanya jika ingin mengganti)</h5>
            <p class="text-muted small">Kosongkan jika tidak ingin mengganti file. File yang sudah diupload akan dipertahankan.</p>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="foto_new" class="form-label">Pas Foto 3x4 (Baru)</label>
                    <input class="form-control" type="file" id="foto_new" name="foto_new">
                    <div class="form-text">File saat ini: <?= $pendaftar['foto_path'] ?? 'Belum ada' ?></div>
                </div>
                <div class="col-md-6">
                    <label for="skl_new" class="form-label">SKL (Baru)</label>
                    <input class="form-control" type="file" id="skl_new" name="skl_new">
                    <div class="form-text">File saat ini: <?= $pendaftar['skl_path'] ?? 'Belum ada' ?></div>
                </div>
            </div>
             <div class="row mb-3">
                <div class="col-md-6">
                    <label for="ktp_ortu_new" class="form-label">KTP Orang Tua (Baru)</label>
                    <input class="form-control" type="file" id="ktp_ortu_new" name="ktp_ortu_new">
                    <div class="form-text">File saat ini: <?= $pendaftar['ktp_ayah_path'] ?? 'Belum ada' ?></div>
                </div>
                 <div class="col-md-6">
                    <label for="akta_new" class="form-label">Akta Kelahiran (Baru)</label>
                    <input class="form-control" type="file" id="akta_new" name="akta_new">
                    <div class="form-text">File saat ini: <?= $pendaftar['akta_path'] ?? 'Belum ada' ?></div>
                </div>
            </div>
             <div class="row mb-3">
                <div class="col-md-6">
                    <label for="skkb_new" class="form-label">SKKB (Baru)</label>
                    <input class="form-control" type="file" id="skkb_new" name="skkb_new">
                    <div class="form-text">File saat ini: <?= $pendaftar['skkb_path'] ?? 'Belum ada' ?></div>
                </div>

               <div class="col-md-6">
                    <label for="dok_kk_new" class="form-label">Kartu Keluarga (KK) (Baru)</label>
                    <input class="form-control" type="file" id="dok_kk_new" name="dok_kk_new">
                    <div class="form-text">File saat ini: <?= $pendaftar['kk_path'] ?? 'Belum ada' ?></div>
                </div>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan & Ajukan Ulang</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?= $this->endSection() ?>