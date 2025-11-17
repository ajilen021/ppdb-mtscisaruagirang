<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= esc($title) ?></h1>
            </div><div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Data Calon Siswa</li>
                </ol>
            </div></div></div></div>
<section class="content">
    <div class="container-fluid">

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= esc(session()->getFlashdata('success')) ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= esc(session()->getFlashdata('error')) ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                         <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Tabel Seluruh Pendaftar</h3>
                            <div class="card-tools d-flex align-items-center">
                                <div class="form-group mb-0 mr-2" style="min-width: 180px;">
                                    <label for="statusFilter" class="sr-only">Filter Status:</label>
                                    <select id="statusFilter" class="form-control form-control-sm">
                                        <option value="">Semua Status</option>
                                        <option value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
                                        <option value="Diterima">Diterima</option>
                                        <option value="Ditolak">Ditolak</option>
                                    </select>
                                </div>
                                <a href="<?= base_url('/admin/pendaftar/export') ?>" class="btn btn-success btn-sm">
                                    <i class="fas fa-file-excel"></i> Export Excel
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="pendaftarTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">No.</th>
                                    <th>Nama Lengkap</th>
                                    <th>Asal Sekolah</th>
                                    <th>Status</th>
                                    <th style="width: 120px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                </tbody>
                        </table>
                    </div>
                    </div>
                </div>
        </div>
        </div></section>
        
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Calon Siswa: <span id="modalNama"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <img id="modalFoto" src="https://placehold.co/300x400/EFEFEF/AAAAAA&text=Foto+3x4" class="img-fluid rounded mb-3" alt="Pas Foto">
                        <h5>Status: <span id="modalStatusBadge" class="badge badge-secondary">-</span></h5>
                    </div>
                    <div class="col-md-9">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="data-siswa-tab" data-toggle="tab" href="#data-siswa" role="tab" aria-controls="data-siswa" aria-selected="true">Data Siswa</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="data-ortu-tab" data-toggle="tab" href="#data-ortu" role="tab" aria-controls="data-ortu" aria-selected="false">Data Ortu/Wali</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="data-dokumen-tab" data-toggle="tab" href="#data-dokumen" role="tab" aria-controls="data-dokumen" aria-selected="false">Dokumen</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="data-siswa" role="tabpanel" aria-labelledby="data-siswa-tab">
                                <table class="table table-sm table-striped table-bordered mt-3">
                                    <tbody>
                                        <tr><th style="width: 180px;">Nama Panggilan</th><td id="modalPanggilan">-</td></tr>
                                        <tr><th>TTL</th><td id="modalTTL">-</td></tr>
                                        <tr><th>Jenis Kelamin</th><td id="modalJk">-</td></tr>
                                        <tr><th>Agama</th><td id="modalAgama">-</td></tr>
                                        <tr><th>Kewarganegaraan</th><td id="modalKwn">-</td></tr>
                                        <tr><th>Anak Ke-</th><td id="modalAnakKe">-</td></tr>
                                        <tr><th>Jml Saudara</th><td id="modalSaudara">-</td></tr>
                                        <tr><th>Alamat Siswa</th><td id="modalAlamat">-</td></tr>
                                        <tr><th>Tinggal Bersama</th><td id="modalTinggal">-</td></tr>
                                        <tr><th>NIK Siswa</th><td id="modalNik">-</td></tr>
                                        <tr><th>No. KK</th><td id="modalKk">-</td></tr>
                                        <tr><th>No. HP Siswa</th><td id="modalHp">-</td></tr>
                                        <tr><th>Asal Sekolah</th><td id="modalSekolah">-</td></tr>
                                        <tr><th>Status Masuk</th><td id="modalStatusMasuk">-</td></tr>
                                        <tr id="rowKelasPindahan" style="display: none;"><th>Diterima di Kelas</th><td id="modalDiterimaKelas">-</td></tr>
                                        <tr id="rowTglPindahan" style="display: none;"><th>Tanggal Diterima</th><td id="modalTglDiterima">-</td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="data-ortu" role="tabpanel" aria-labelledby="data-ortu-tab">
                                <table class="table table-sm table-striped table-bordered mt-3">
                                    <tbody>
                                        <tr><th style="width: 180px;">Nama Ayah</th><td id="modalAyah">-</td></tr>
                                        <tr><th>Pekerjaan Ayah</th><td id="modalPekerjaanAyah">-</td></tr>
                                        <tr><th>Nama Ibu</th><td id="modalIbu">-</td></tr>
                                        <tr><th>Pekerjaan Ibu</th><td id="modalPekerjaanIbu">-</td></tr>
                                        <tr><th>Alamat Ortu</th><td id="modalAlamatOrtu">-</td></tr>
                                        <tr><th>No. HP Ortu</th><td id="modalHpOrtu">-</td></tr>
                                        <tr><th>Nama Wali</th><td id="modalWali">-</td></tr>
                                        <tr><th>Alamat Wali</th><td id="modalAlamatWali">-</td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="data-dokumen" role="tabpanel" aria-labelledby="data-dokumen-tab">
                                <div class="mt-3" id="modalDokumenLinks">
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <form action="<?= base_url('/admin/pendaftar/update') ?>" method="post" id="formAksiPendaftar" class="w-100">
                    <?= csrf_field() ?>
                    <input type="hidden" name="pendaftar_id" id="modalPendaftarId">
                    <input type="hidden" name="status_aksi" id="modalStatusAksi">

                    <div class="form-group" id="alasanTolakGroup" style="display: none;">
                        <label for="modalAlasanPenolakan">Alasan Penolakan (Wajib diisi jika ditolak):</label>
                        <textarea class="form-control" name="alasan_penolakan" id="modalAlasanPenolakan" rows="2" required></textarea>
                        <button type="submit" class="btn btn-danger mt-2" id="btnSubmitTolak">Submit Penolakan</button>
                    </div>

                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-success" id="btnSetujuModal">Setujui</button>
                        <button type="button" class="btn btn-danger" id="btnTolakModal">Tolak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document"> <div class="modal-content">
            <form action="<?= base_url('/admin/pendaftar/fullupdate') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="pendaftar_id" id="editPendaftarId">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data: <span id="editNamaSiswa"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" id="editTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="edit-siswa-tab" data-toggle="tab" href="#edit-siswa" role="tab" aria-controls="edit-siswa" aria-selected="true">Data Siswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="edit-ortu-tab" data-toggle="tab" href="#edit-ortu" role="tab" aria-controls="edit-ortu" aria-selected="false">Data Ortu/Wali</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="edit-kependudukan-tab" data-toggle="tab" href="#edit-kependudukan" role="tab" aria-controls="edit-kependudukan" aria-selected="false">Kependudukan & Status</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="editTabContent">
                        
                        <div class="tab-pane fade show active" id="edit-siswa" role="tabpanel" aria-labelledby="edit-siswa-tab">
                            <h5 class="mt-4">A. Data Calon Siswa</h5>
                            <div class="row mb-3">
                                <div class="col-md-8"><label>Nama Lengkap</label><input type="text" class="form-control" name="nama_lengkap" id="editNamaLengkap" required></div>
                                <div class="col-md-4"><label>Nama Panggilan</label><input type="text" class="form-control" name="nama_panggilan" id="editNamaPanggilan"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6"><label>Tempat Lahir</label><input type="text" class="form-control" name="tempat_lahir" id="editTempatLahir" required></div>
                                <div class="col-md-6"><label>Tanggal Lahir</label><input type="date" class="form-control" name="tanggal_lahir" id="editTanggalLahir" required></div>
                            </div>
                             <div class="row mb-3">
                                <div class="col-md-4"><label>Jenis Kelamin</label>
                                    <select class="form-control" name="jenis_kelamin" id="editJenisKelamin" required>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-4"><label>Agama</label>
                                    <select class="form-control" name="agama" id="editAgama" required>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen Protestan">Kristen Protestan</option>
                                        <option value="Kristen Katolik">Kristen Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Khonghucu">Khonghucu</option>
                                    </select>
                                </div>
                                <div class="col-md-4"><label>Kewarganegaraan</label>
                                    <select class="form-control" name="kewarganegaraan" id="editKewarganegaraan" required>
                                        <option value="WNI">WNI</option>
                                        <option value="WNA">WNA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><label>Anak Ke-</label><input type="number" class="form-control" name="anak_ke" id="editAnakKe"></div>
                                <div class="col-md-4"><label>Jumlah Kakak</label><input type="number" class="form-control" name="jumlah_kakak" id="editJumlahKakak"></div>
                                <div class="col-md-4"><label>Jumlah Adik</label><input type="number" class="form-control" name="jumlah_adik" id="editJumlahAdik"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-8"><label>Alamat Lengkap Siswa</label><textarea class="form-control" name="alamat" id="editAlamat" rows="3" required></textarea></div>
                                <div class="col-md-4"><label>Tinggal Bersama</label>
                                    <select class="form-control" name="tinggal_bersama" id="editTinggalBersama" required>
                                        <option value="Orang Tua">Orang Tua</option>
                                        <option value="Saudara">Saudara</option>
                                        <option value="Kost">Kost</option>
                                        <option value="Asrama">Asrama</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6"><label>Nomor HP/WA Orang Tua</label><input type="tel" class="form-control" name="no_hp" id="editNoHp" required></div>
                                <div class="col-md-6"><label>Asal Sekolah (SD/MI)</label><input type="text" class="form-control" name="asal_sekolah" id="editAsalSekolah" required></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><label>Status Masuk</label>
                                    <select class="form-control" name="status_masuk" id="editStatusMasuk">
                                        <option value="Baru">Siswa Baru Kelas VII</option>
                                        <option value="Pindahan">Siswa Pindahan</option>
                                    </select>
                                </div>
                                <div class="col-md-4"><label>Diterima di Kelas (Pindahan)</label><input type="text" class="form-control" name="diterima_kelas" id="editDiterimaKelas"></div>
                                <div class="col-md-4"><label>Tgl Diterima (Pindahan)</label><input type="date" class="form-control" name="tanggal_diterima" id="editTanggalDiterima"></div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="edit-ortu" role="tabpanel" aria-labelledby="edit-ortu-tab">
                             <h5 class="mt-4">B. Data Orang Tua</h5>
                             <div class="row mb-3">
                                <div class="col-md-6"><label>Nama Ayah</label><input type="text" class="form-control" name="nama_ayah" id="editNamaAyah" required></div>
                                <div class="col-md-6"><label>Pekerjaan Ayah</label><input type="text" class="form-control" name="pekerjaan_ayah" id="editPekerjaanAyah" required></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6"><label>Nama Ibu</label><input type="text" class="form-control" name="nama_ibu" id="editNamaIbu" required></div>
                                <div class="col-md-6"><label>Pekerjaan Ibu</label><input type="text" class="form-control" name="pekerjaan_ibu" id="editPekerjaanIbu" required></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-8"><label>Alamat </label><textarea class="form-control" name="alamat_ortu" id="editAlamatOrtu" rows="2"></textarea></div>
                                <div class="col-md-4"><label>Nomor HP </label><input type="tel" class="form-control" name="no_hp_ortu" id="editNoHpOrtu"></div>
                            </div>
                            <h5 class="mt-4">C. Data Wali (Jika Ada)</h5>
                            <div class="row mb-3">
                                <div class="col-md-6"><label>Nama Wali</label><input type="text" class="form-control" name="nama_wali" id="editNamaWali"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12"><label>Alamat Wali</label><textarea class="form-control" name="alamat_wali" id="editAlamatWali" rows="2"></textarea></div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="edit-kependudukan" role="tabpanel" aria-labelledby="edit-kependudukan-tab">
                            <h5 class="mt-4">D. Data Kependudukan</h5>
                            <div class="row mb-3">
                                <div class="col-md-6"><label>NIK Siswa</label><input type="text" class="form-control" name="nik" id="editNik" maxlength="16" required></div>
                                <div class="col-md-6"><label>Nomor Kartu Keluarga (KK)</label><input type="text" class="form-control" name="no_kk" id="editNoKk" maxlength="16" required></div>
                            </div>
                            <h5 class="mt-4">E. Status Pendaftaran</h5>
                             <div class="row mb-3">
                                 <div class="col-md-6">
                                     <label>Status</label>
                                     <select class="form-control" name="status" id="editStatus" required>
                                        <option value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
                                        <option value="Diterima">Diterima</option>
                                        <option value="Ditolak">Ditolak</option>
                                    </select>
                                 </div>
                                  <div class="col-md-6">
                                     <label>Alasan Penolakan (Jika ditolak)</label>
                                     <textarea class="form-control" name="alasan_penolakan" id="editAlasanPenolakan" rows="2"></textarea>
                                 </div>
                             </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
  $(function () {
    // Inisialisasi DataTable dengan AJAX
    var table = $("#pendaftarTable").DataTable({
        "processing": true, // Tampilkan indikator loading
        "serverSide": true, // Aktifkan server-side processing
        "ajax": {
            "url": "<?= base_url('/admin/pendaftar/data') ?>", // URL ke controller untuk ambil data
            "type": "POST",
            "data": function (d) {
                // Kirim filter status jika dipilih
                d.status_filter = $('#statusFilter').val();
                // Kirim token CSRF
                d['<?= csrf_token() ?>'] = '<?= csrf_hash() ?>'; 
            }
        },
        "columns": [ // Definisikan kolom sesuai data dari controller
            { "data": "no", "orderable": false, "searchable": false }, // Kolom nomor
            { "data": "nama_lengkap" },
            { "data": "asal_sekolah" },
            { "data": "status" },
            { "data": "aksi", "orderable": false, "searchable": false } // Kolom Aksi
        ],
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "order": [[ 1, "asc" ]], // Urutkan berdasarkan Nama Lengkap (kolom index 1)
        "language": { // Terjemahan DataTables (opsional)
            "processing": "Memuat data...",
            "search": "Cari:",
            "lengthMenu": "Tampilkan _MENU_ data",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ pendaftar",
            "infoEmpty": "Tidak ada data",
            "infoFiltered": "(difilter dari _MAX_ total data)",
            "zeroRecords": "Tidak ada data yang cocok",
            "paginate": {
                "first": "Awal",
                "last": "Akhir",
                "next": "Berikutnya",
                "previous": "Sebelumnya"
            },
        }
    });

    // Event handler ketika filter status berubah
    $('#statusFilter').on('change', function(){
        table.ajax.reload(); // Muat ulang data tabel dengan filter baru
    });

    // --- (Kode JavaScript Modal Anda yang lama tetap di sini) ---
     // Helper function createDocumentLink
    function createDocumentLink(url, text, isWajib) {
        if (url) {
            return `<a href="${url}" target="_blank" class="btn btn-primary btn-xs mb-1">${text}</a><br>`;
        } else {
             // Modifikasi sedikit agar lebih jelas
            let wajibText = isWajib ? '<span class="text-danger small">(Wajib)</span>' : '<span class="text-muted small">(Opsional)</span>';
            return `<span class="text-muted">${text}: Tidak diupload ${wajibText}</span><br>`;
        }
    }

    // Event Delegation untuk tombol view karena tabel di-load AJAX
    $('#pendaftarTable tbody').on('click', '.btn-view', function () {
        const data = $(this).data();

        // (SEMUA KODE UNTUK MENGISI MODAL ANDA TETAP SAMA DI SINI)
        // --- Isi Data ke Modal ---
        $('#modalPendaftarId').val(data.id);
        $('#modalNama').text(data.nama);
        $('#modalPanggilan').text(data.panggilan || '-');
        $('#modalStatusBadge').text(data.status);
        // ... (lanjutkan mengisi semua field modal) ...
         $('#modalSekolah').text(data.sekolah);
         $('#modalTTL').text(data.ttl); // data.ttl masih format 'Tempat, tgl bln thn'
         $('#modalAgama').text(data.agama || '-');
        $('#modalKwn').text(data.kwn || '-');
        $('#modalAnakKe').text(data.anakke || '-');
        $('#modalSaudara').text(`Kakak: ${data.kakak ?? '-'}, Adik: ${data.adik ?? '-'}`);
        $('#modalJk').text(data.jk);
        $('#modalAlamat').text(data.alamat);
        $('#modalTinggal').text(data.tinggal || '-');
        $('#modalHp').text(data.hp);
        $('#modalNik').text(data.nik);
        $('#modalKk').text(data.kk);
        $('#modalFoto').attr('src', data.foto);

        // Data Ortu
        $('#modalAyah').text(data.ayah);
        $('#modalPekerjaanAyah').text(data.pekerjaanayah);
        $('#modalIbu').text(data.ibu);
        $('#modalPekerjaanIbu').text(data.pekerjaanibu);
        $('#modalAlamatOrtu').text(data.alamatortu || '-');
        $('#modalHpOrtu').text(data.hportu || '-');

        // Data Wali
        $('#modalWali').text(data.wali || '-');
        $('#modalAlamatWali').text(data.alamatwali || '-');

        // Data Sekolah Pindahan
        $('#modalStatusMasuk').text(data.statusmasuk);
        if (data.statusmasuk === 'Pindahan') {
            $('#modalDiterimaKelas').text(data.diterimakelas || '-');
            // Tgl diterima di data-attributes sudah diubah jadi Y-m-d, tapi di view kita format lagi
            let tglDiterimaFormatted = data.tglditerima ? new Date(data.tglditerima).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' }) : '-';
            $('#modalTglDiterima').text(tglDiterimaFormatted);
            $('#rowKelasPindahan, #rowTglPindahan').show();
        } else {
            $('#rowKelasPindahan, #rowTglPindahan').hide();
        }


        // --- Atur Status Badge Class ---
        $('#modalStatusBadge').removeClass('badge-success badge-danger badge-warning badge-secondary');
        if (data.status == 'Diterima') {
            $('#modalStatusBadge').addClass('badge-success');
        } else if (data.status == 'Ditolak') {
            $('#modalStatusBadge').addClass('badge-danger');
        } else {
            $('#modalStatusBadge').addClass('badge-warning');
        }

        // --- Buat Link Dokumen ---
        let dokHtml = '';
        dokHtml += createDocumentLink(data.dok_skl, 'SKL', true);
        dokHtml += createDocumentLink(data.dok_ktp_ayah, 'KTP Orang tua', true);
        dokHtml += createDocumentLink(data.dok_akta, 'Akta Kelahiran', true);
        dokHtml += createDocumentLink(data.dok_skkb, 'SKKB', true);
        dokHtml += createDocumentLink(data.dok_kk, 'Kartu Keluarga (KK)', true); 
        $('#modalDokumenLinks').html(dokHtml);

        // --- Reset Tampilan Form Aksi ---
        $('#alasanTolakGroup').hide(); // Sembunyikan grup alasan
        $('#modalAlasanPenolakan').val(data.alasan || ''); // Isi alasan jika sudah ada
        $('#modalAlasanPenolakan').prop('readonly', false); // Pastikan bisa diedit lagi
        $('#btnTolakModal, #btnSetujuModal').show(); // Tampilkan kedua tombol aksi di footer
        $('#btnSubmitTolak').show(); // Pastikan tombol submit di grup alasan terlihat


        // --- Logika Tombol Aksi berdasarkan Status ---
        if (data.status == 'Diterima' || data.status == 'Ditolak') {
            // Jika status sudah final, sembunyikan tombol aksi di footer
            $('#btnTolakModal, #btnSetujuModal').hide();

            // Jika ditolak, tampilkan alasan (tapi read-only)
            if(data.status == 'Ditolak') {
                 $('#alasanTolakGroup').show();
                 $('#modalAlasanPenolakan').prop('readonly', true);
                 $('#btnSubmitTolak').hide(); // Sembunyikan tombol submit
            }
        }
    });

    // ==============================================
    //     JAVASCRIPT BARU UNTUK MODAL EDIT
    // ==============================================
    $('#pendaftarTable tbody').on('click', '.btn-edit', function () {
        const data = $(this).data();

        // Isi form di #editModal
        $('#editPendaftarId').val(data.id);
        $('#editNamaSiswa').text(data.nama);

        // Tab Siswa
        $('#editNamaLengkap').val(data.nama);
        $('#editNamaPanggilan').val(data.panggilan);
        $('#editTempatLahir').val(data.tempatlahir); // Gunakan data-tempatlahir
        $('#editTanggalLahir').val(data.tanggallahir); // Gunakan data-tanggallahir (Y-m-d)
        $('#editJenisKelamin').val(data.jk);
        $('#editAgama').val(data.agama);
        $('#editKewarganegaraan').val(data.kwn);
        $('#editAnakKe').val(data.anakke);
        $('#editJumlahKakak').val(data.kakak);
        $('#editJumlahAdik').val(data.adik);
        $('#editAlamat').val(data.alamat);
        $('#editTinggalBersama').val(data.tinggal);
        $('#editNoHp').val(data.hp);
        $('#editAsalSekolah').val(data.sekolah);
        $('#editStatusMasuk').val(data.statusmasuk);
        $('#editDiterimaKelas').val(data.diterimakelas);
        $('#editTanggalDiterima').val(data.tglditerima); // Gunakan data-tglditerima (Y-m-d)
        
        // Tab Ortu/Wali
        $('#editNamaAyah').val(data.ayah);
        $('#editPekerjaanAyah').val(data.pekerjaanayah);
        $('#editNamaIbu').val(data.ibu);
        $('#editPekerjaanIbu').val(data.pekerjaanibu);
        $('#editAlamatOrtu').val(data.alamatortu);
        $('#editNoHpOrtu').val(data.hportu);
        $('#editNamaWali').val(data.wali);
        $('#editAlamatWali').val(data.alamatwali);

        // Tab Kependudukan & Status
        $('#editNik').val(data.nik);
        $('#editNoKk').val(data.kk);
        $('#editStatus').val(data.status);
        $('#editAlasanPenolakan').val(data.alasan);
    });


     // Event handler btnSetujuModal (Gunakan SweetAlert)
    $('#btnSetujuModal').on('click', function() {
        Swal.fire({
            title: 'Konfirmasi Persetujuan',
            text: "Apakah Anda yakin ingin menyetujui pendaftar ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745', // Warna hijau
            cancelButtonColor: '#6c757d', // Warna abu
            confirmButtonText: 'Ya, Setujui!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#modalStatusAksi').val('Diterima');
                $('#formAksiPendaftar').submit();
            }
        })
    });

     // Event handler btnTolakModal
    $('#btnTolakModal').on('click', function() {
        $('#modalStatusAksi').val('Ditolak');
        $('#alasanTolakGroup').slideDown();
        $('#btnTolakModal, #btnSetujuModal').hide();
    });

    // Event Delegation untuk konfirmasi hapus (Gunakan SweetAlert)
     $('#pendaftarTable tbody').on('click', '.btn-delete', function (e) {
        e.preventDefault(); // Mencegah link langsung jalan
        const deleteUrl = $(this).attr('href'); // Ambil URL hapus dari link

        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: "Anda yakin ingin menghapus data pendaftar ini? Tindakan ini tidak bisa dibatalkan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545', // Warna merah
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika dikonfirmasi, lanjutkan ke URL hapus
                window.location.href = deleteUrl;
            }
        })
    });

  });
</script>
<?= $this->endSection() ?>