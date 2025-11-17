<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><?= esc($title); ?> PPDB MTs Cisarua Girang</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted">Silakan isi formulir di bawah ini dengan data yang benar.</p>

                    <!-- Tampilkan error validasi -->
                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Terjadi Kesalahan!</h4>
                            <ul>
                                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                     <!-- Tampilkan error umum -->
                     <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger" role="alert">
                             <?= esc(session()->getFlashdata('error')) ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('/pendaftaran/save') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <h5 class="mt-4 mb-3 border-bottom pb-2">A. Data Calon Siswa</h5>

                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= old('nama_lengkap') ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="nama_panggilan" class="form-label">Nama Panggilan</label>
                                <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan" value="<?= old('nama_panggilan') ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= old('tempat_lahir') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= old('tanggal_lahir') ?>" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                             <div class="col-md-4">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki-laki" <?= old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="Perempuan" <?= old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="agama" class="form-label">Agama <span class="text-danger">*</span></label>
                                <select class="form-select" id="agama" name="agama" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Islam" <?= old('agama') == 'Islam' ? 'selected' : '' ?>>Islam</option>
                                    <option value="Kristen Protestan" <?= old('agama') == 'Kristen Protestan' ? 'selected' : '' ?>>Kristen Protestan</option>
                                    <option value="Kristen Katolik" <?= old('agama') == 'Kristen Katolik' ? 'selected' : '' ?>>Kristen Katolik</option>
                                    <option value="Hindu" <?= old('agama') == 'Hindu' ? 'selected' : '' ?>>Hindu</option>
                                    <option value="Buddha" <?= old('agama') == 'Buddha' ? 'selected' : '' ?>>Buddha</option>
                                    <option value="Khonghucu" <?= old('agama') == 'Khonghucu' ? 'selected' : '' ?>>Khonghucu</option>
                                </select>
                            </div>
                             <div class="col-md-4">
                                <label for="kewarganegaraan" class="form-label">Kewarganegaraan <span class="text-danger">*</span></label>
                                <select class="form-select" id="kewarganegaraan" name="kewarganegaraan" required>
                                    <option value="WNI" <?= old('kewarganegaraan', 'WNI') == 'WNI' ? 'selected' : '' ?>>WNI</option>
                                    <option value="WNA" <?= old('kewarganegaraan') == 'WNA' ? 'selected' : '' ?>>WNA</option>
                                </select>
                            </div>
                        </div>

                         <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="anak_ke" class="form-label">Anak Ke-</label>
                                <input type="number" class="form-control" id="anak_ke" name="anak_ke" value="<?= old('anak_ke') ?>" min="1">
                            </div>
                            <div class="col-md-4">
                                <label for="jumlah_kakak" class="form-label">Jumlah Kakak</label>
                                <input type="number" class="form-control" id="jumlah_kakak" name="jumlah_kakak" value="<?= old('jumlah_kakak') ?>" min="0">
                            </div>
                             <div class="col-md-4">
                                <label for="jumlah_adik" class="form-label">Jumlah Adik</label>
                                <input type="number" class="form-control" id="jumlah_adik" name="jumlah_adik" value="<?= old('jumlah_adik') ?>" min="0">
                            </div>
                        </div>

                         <div class="row mb-3">
                             <div class="col-md-8">
                                <label for="alamat" class="form-label">Alamat Lengkap Siswa <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= old('alamat') ?></textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="tinggal_bersama" class="form-label">Tinggal Bersama <span class="text-danger">*</span></label>
                                <select class="form-select" id="tinggal_bersama" name="tinggal_bersama" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Orang Tua" <?= old('tinggal_bersama') == 'Orang Tua' ? 'selected' : '' ?>>Orang Tua</option>
                                    <option value="Saudara" <?= old('tinggal_bersama') == 'Saudara' ? 'selected' : '' ?>>Saudara</option>
                                    <option value="Kost" <?= old('tinggal_bersama') == 'Kost' ? 'selected' : '' ?>>Kost</option>
                                    <option value="Asrama" <?= old('tinggal_bersama') == 'Asrama' ? 'selected' : '' ?>>Asrama</option>
                                    <option value="Lainnya" <?= old('tinggal_bersama') == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                                </select>
                            </div>
                         </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="no_hp" class="form-label">Nomor HP/WA Orang Tua (Aktif) <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="no_hp" name="no_hp" value="<?= old('no_hp') ?>" placeholder="Contoh: 081234567890" required>
                            </div>
                             <div class="col-md-6">
                                <label for="asal_sekolah" class="form-label">Nama Asal Sekolah (SD/MI) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="<?= old('asal_sekolah') ?>" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="form-label">Masuk Sebagai <span class="text-danger">*</span></label>
                             <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_masuk" id="status_baru" value="Baru" <?= old('status_masuk', 'Baru') == 'Baru' ? 'checked' : '' ?> onclick="togglePindahanFields(false)">
                                    <label class="form-check-label" for="status_baru">
                                        Siswa Baru Kelas VII
                                    </label>
                                </div>
                            </div>
                             <div class="col-md-6">
                                 <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_masuk" id="status_pindahan" value="Pindahan" <?= old('status_masuk') == 'Pindahan' ? 'checked' : '' ?> onclick="togglePindahanFields(true)">
                                    <label class="form-check-label" for="status_pindahan">
                                        Siswa Pindahan
                                    </label>
                                </div>
                             </div>
                        </div>

                        <!-- Field Khusus Pindahan (Muncul jika dipilih) -->
                        <div id="pindahanFields" style="display: <?= old('status_masuk') == 'Pindahan' ? 'block' : 'none' ?>;">
                             <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="diterima_kelas" class="form-label">Diterima di Kelas <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="diterima_kelas" name="diterima_kelas" value="<?= old('diterima_kelas') ?>" placeholder="Contoh: VIII A">
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal_diterima" class="form-label">Pada Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tanggal_diterima" name="tanggal_diterima" value="<?= old('tanggal_diterima') ?>">
                                </div>
                             </div>
                        </div>


                        <h5 class="mt-5 mb-3 border-bottom pb-2">B. Data Orang Tua</h5>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nama_ayah" class="form-label">Nama Ayah <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="<?= old('nama_ayah') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" value="<?= old('pekerjaan_ayah') ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nama_ibu" class="form-label">Nama Ibu <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="<?= old('nama_ibu') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" value="<?= old('pekerjaan_ibu') ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                             <div class="col-md-8">
                                <label for="alamat_ortu" class="form-label">Alamat Orang Tua (Jika berbeda dengan siswa)</label>
                                <textarea class="form-control" id="alamat_ortu" name="alamat_ortu" rows="2"><?= old('alamat_ortu') ?></textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="no_hp_ortu" class="form-label">Nomor HP Siswa </label>
                                <input type="tel" class="form-control" id="no_hp_ortu" name="no_hp_ortu" value="<?= old('no_hp_ortu') ?>" placeholder="Contoh: 081234567890">
                            </div>
                        </div>

                        <h5 class="mt-5 mb-3 border-bottom pb-2">C. Data Wali (Jika Ada)</h5>
                        <p class="text-muted small">Kosongkan bagian ini jika siswa tinggal bersama orang tua.</p>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nama_wali" class="form-label">Nama Wali</label>
                                <input type="text" class="form-control" id="nama_wali" name="nama_wali" value="<?= old('nama_wali') ?>">
                            </div>
                        </div>
                         <div class="row mb-3">
                             <div class="col-md-12">
                                <label for="alamat_wali" class="form-label">Alamat Wali</label>
                                <textarea class="form-control" id="alamat_wali" name="alamat_wali" rows="2"><?= old('alamat_wali') ?></textarea>
                            </div>
                        </div>


                        <h5 class="mt-5 mb-3 border-bottom pb-2">D. Data Kependudukan</h5>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nik" class="form-label">NIK Siswa (Sesuai KK) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nik" name="nik" value="<?= old('nik') ?>" maxlength="16" required>
                                <div class="form-text">Masukkan 16 digit Nomor Induk Kependudukan.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="no_kk" class="form-label">Nomor Kartu Keluarga (KK) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="no_kk" name="no_kk" value="<?= old('no_kk') ?>" maxlength="16" required>
                                 <div class="form-text">Masukkan 16 digit Nomor Kartu Keluarga.</div>
                            </div>
                        </div>

                        <h5 class="mt-5 mb-3 border-bottom pb-2">E. Upload Dokumen</h5>
                        <p class="text-danger small">Dokumen wajib diupload: SKL, KTP Orangtua/Wali, Akta Kelahiran, SKKB.</p>
                        <p class="text-muted small">Format file: PDF, JPG, PNG, JPEG. Maksimal ukuran per file: 2MB.</p>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="foto" class="form-label">Pas Foto 3x4 (Opsional)</label>
                                <input class="form-control" type="file" id="foto" name="foto">
                                <div class="form-text">Maksimal 1MB.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="skl" class="form-label">Surat Keterangan Lulus (SKL) <span class="text-danger">*</span></label>
                                <input class="form-control" type="file" id="skl" name="skl" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="ktp_ortu" class="form-label">KTP Orang Tua/Wali <span class="text-danger">*</span></label>
                                <input class="form-control" type="file" id="ktp_ortu" name="ktp_ortu" required>
                                <div class="form-text"></div>
                            </div>
                         <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="akta" class="form-label">Fotokopi Akta Kelahiran <span class="text-danger">*</span></label>
                                <input class="form-control" type="file" id="akta" name="akta" required>
                            </div>
                             <div class="col-md-6">
                                <label for="skkb" class="form-label">Surat Keterangan Kelakuan Baik (SKKB) <span class="text-danger">*</span></label>
                                <input class="form-control" type="file" id="skkb" name="skkb" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-md-6">
                                <label for="dokumen_kk" class="form-label">Fotokopi Kartu Keluarga (KK) <span class="text-danger">*</span></label>
                                <input class="form-control" type="file" id="dokumen_kk" name="dokumen_kk" required> 
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Kirim Pendaftaran</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk toggle field Pindahan -->
<script>
    function togglePindahanFields(show) {
        const pindahanDiv = document.getElementById('pindahanFields');
        const kelasInput = document.getElementById('diterima_kelas');
        const tanggalInput = document.getElementById('tanggal_diterima');
        
        if (show) {
            pindahanDiv.style.display = 'block';
            kelasInput.required = true;
            tanggalInput.required = true;
        } else {
            pindahanDiv.style.display = 'none';
            kelasInput.required = false;
            tanggalInput.required = false;
            // Kosongkan nilai jika disembunyikan
            // kelasInput.value = ''; 
            // tanggalInput.value = '';
        }
    }
    // Panggil saat halaman dimuat untuk memastikan kondisi awal benar
    document.addEventListener('DOMContentLoaded', function() {
        const isPindahan = document.getElementById('status_pindahan').checked;
        togglePindahanFields(isPindahan);
    });
</script>

<?= $this->endSection() ?>

