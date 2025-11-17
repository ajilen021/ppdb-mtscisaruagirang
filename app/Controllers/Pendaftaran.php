<?php

namespace App\Controllers;

use App\Models\PendaftarModel;
use Dompdf\Dompdf;

class Pendaftaran extends BaseController
{
    protected $pendaftarModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->pendaftarModel = new PendaftarModel();
    }

    // Menampilkan form pendaftaran
    public function index()
    {
        // Cek apakah user sudah pernah mendaftar
        $existingData = $this->pendaftarModel->getPendaftarByUserId(session()->get('id'));
        if ($existingData) {
            // Jika sudah, arahkan ke halaman bukti pendaftaran
            return redirect()->to('/pendaftaran/bukti');
        }

        return view('pendaftaran/form', [
            'title' => 'Form Pendaftaran',
            'validation' => \Config\Services::validation() // Kirim validation service ke view
        ]);
    }

    // Menyimpan data dari form
    public function save()
    {
    // Aturan validasi
    $rules = [
        'nama_lengkap'    => 'required|min_length[3]|max_length[255]',
        'nama_panggilan'  => 'max_length[100]',
        'tempat_lahir'    => 'required',
        'tanggal_lahir'   => 'required|valid_date',
        'agama'           => 'required',
        'kewarganegaraan' => 'required',
        'anak_ke'         => 'permit_empty|integer',
        'jumlah_kakak'    => 'permit_empty|integer',
        'jumlah_adik'     => 'permit_empty|integer',
        'jenis_kelamin'   => 'required',
        'alamat'          => 'required',
        'tinggal_bersama' => 'required',
        'asal_sekolah'    => 'required',
        'nama_ibu'        => 'required',
        'pekerjaan_ayah'  => 'required',
        'pekerjaan_ibu'   => 'required',
        'alamat_ortu'     => 'permit_empty',
        'no_hp_ortu'      => 'permit_empty|numeric|min_length[10]',
        'nama_wali'       => 'permit_empty|max_length[255]',
        'alamat_wali'     => 'permit_empty',
        'nik'             => 'required|numeric|exact_length[16]|is_unique[pendaftar.nik]',
        'no_kk'           => 'required|numeric|exact_length[16]|is_unique[pendaftar.no_kk]',
        'no_hp'           => 'required|numeric|min_length[10]',
        // File Uploads
        'foto'            => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
        'dokumen_kk'      => 'uploaded[dokumen_kk]|max_size[dokumen_kk,2048]|ext_in[dokumen_kk,pdf,jpg,png,jpeg]',
        'skl'             => 'uploaded[skl]|max_size[skl,2048]|ext_in[skl,pdf,jpg,png,jpeg]',
        'ktp_ortu'        => 'uploaded[ktp_ortu]|max_size[ktp_ortu,2048]|ext_in[ktp_ortu,pdf,jpg,png,jpeg]',
        'akta'            => 'uploaded[akta]|max_size[akta,2048]|ext_in[akta,pdf,jpg,png,jpeg]',
        'skkb'            => 'uploaded[skkb]|max_size[skkb,2048]|ext_in[skkb,pdf,jpg,png,jpeg]',
    ];

    // --- PESAN VALIDASI KUSTOM ---
    $validationMessages = [
        'nik' => [
            'is_unique' => 'NIK sudah terdaftar, silakan masukkan NIK dengan benar.',
        ],
        'no_kk' => [
            'is_unique' => 'Nomor KK sudah terdaftar, silakan masukkan Nomor KK dengan benar.',
        ],
    ];

    // Lakukan validasi dengan pesan kustom
    if (!$this->validate($rules, $validationMessages)) {
        // Kembali ke form dengan input lama dan error validasi
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // --- Proses Upload File ---
    $uploadedFiles = [];
    $fileFields = ['foto', 'dokumen_kk', 'skl', 'ktp_ortu', 'akta', 'skkb'];
    $uploadPaths = [
        'foto'       => 'uploads/foto',
        'dokumen_kk' => 'uploads/dokumen',
        'skl'        => 'uploads/dokumen',
        'ktp_ortu'   => 'uploads/dokumen',
        'akta'       => 'uploads/dokumen',
        'skkb'       => 'uploads/dokumen',
    ];

    foreach ($fileFields as $field) {
        $file = $this->request->getFile($field);

        $dbColumn = '';
        if ($field === 'dokumen_kk') {
            $dbColumn = 'kk_path';
        } elseif ($field === 'ktp_ortu') {
            $dbColumn = 'ktp_ayah_path';
        } else {
            $dbColumn = $field . '_path';
        }

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            if ($file->move($uploadPaths[$field], $newName)) {
                $uploadedFiles[$dbColumn] = $newName;
            } else {
                log_message('error', 'Gagal mengupload file ' . $field . ': ' . $file->getErrorString());
                return redirect()->back()->withInput()->with('error', 'Gagal mengupload file: ' . $field);
            }
        } else {
            if ($field === 'foto') {
                 $uploadedFiles[$dbColumn] = null;
            }
        }
    }


    // --- Siapkan Data untuk Disimpan ---
    $dataToSave = [
        'user_id'         => session()->get('id'),
        'nama_lengkap'    => $this->request->getPost('nama_lengkap'),
        'nama_panggilan'  => $this->request->getPost('nama_panggilan'),
        'tempat_lahir'    => $this->request->getPost('tempat_lahir'),
        'tanggal_lahir'   => $this->request->getPost('tanggal_lahir'),
        'agama'           => $this->request->getPost('agama'),
        'kewarganegaraan' => $this->request->getPost('kewarganegaraan'),
        'anak_ke'         => $this->request->getPost('anak_ke') ?: null,
        'jumlah_kakak'    => $this->request->getPost('jumlah_kakak') ?: null,
        'jumlah_adik'     => $this->request->getPost('jumlah_adik') ?: null,
        'jenis_kelamin'   => $this->request->getPost('jenis_kelamin'),
        'alamat'          => $this->request->getPost('alamat'),
        'tinggal_bersama' => $this->request->getPost('tinggal_bersama'),
        'asal_sekolah'    => $this->request->getPost('asal_sekolah'),
        'status_masuk'    => $this->request->getPost('status_masuk'),
        'diterima_kelas'  => ($this->request->getPost('status_masuk') === 'Pindahan') ? $this->request->getPost('diterima_kelas') : null,
        'tanggal_diterima'=> ($this->request->getPost('status_masuk') === 'Pindahan') ? $this->request->getPost('tanggal_diterima') : null,
        'nama_ayah'       => $this->request->getPost('nama_ayah'),
        'nama_ibu'        => $this->request->getPost('nama_ibu'),
        'pekerjaan_ayah'  => $this->request->getPost('pekerjaan_ayah'),
        'pekerjaan_ibu'   => $this->request->getPost('pekerjaan_ibu'),
        'alamat_ortu'     => $this->request->getPost('alamat_ortu'),
        'no_hp_ortu'      => $this->request->getPost('no_hp_ortu'),
        'nama_wali'       => $this->request->getPost('nama_wali'),
        'alamat_wali'     => $this->request->getPost('alamat_wali'),
        'nik'             => $this->request->getPost('nik'),
        'no_kk'           => $this->request->getPost('no_kk'),
        'no_hp'           => $this->request->getPost('no_hp'),
        'status'          => 'Menunggu Konfirmasi'
    ];

    // Gabungkan data form dengan data path file
    $finalData = array_merge($dataToSave, $uploadedFiles);

    // --- Simpan ke Database ---
    if ($this->pendaftarModel->save($finalData)) {
        return redirect()->to('/pendaftaran/success');
    } else {
        log_message('error', 'Gagal menyimpan data pendaftar.');
        return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data.');
    }

    } // <--- Akhir dari method save()

    // Menyimpan data dari modal edit user
    public function update()
    {
    // 1. Cek apakah user sudah login dan memiliki data pendaftar (untuk keamanan)
    $userId = session()->get('id');
    $existingData = $this->pendaftarModel->getPendaftarByUserId($userId);

    if (!$existingData || $existingData['status'] !== 'Ditolak') {
        return redirect()->to('/pendaftaran/bukti')->with('error', 'Akses ditolak atau status pendaftaran Anda tidak memperbolehkan update.');
    }

    // Ambil ID pendaftar yang sedang di-update
    $pendaftarId = $existingData['id'];

    // 2. Tentukan aturan validasi
    $rules = [
        'nama_lengkap'    => 'required|min_length[3]|max_length[255]',
        'tempat_lahir'    => 'required',
        'tanggal_lahir'   => 'required|valid_date',
        'jenis_kelamin'   => 'required',
        'alamat'          => 'required',
        'tinggal_bersama' => 'required',
        'asal_sekolah'    => 'required',
        'nik'             => 'required|numeric|exact_length[16]|is_unique[pendaftar.nik,id,' . $pendaftarId . ']',
        'no_kk'           => 'required|numeric|exact_length[16]|is_unique[pendaftar.no_kk,id,' . $pendaftarId . ']',
        'no_hp'           => 'required|numeric|min_length[10]',
        // File: Hanya jika ada file baru yang diupload
        'foto_new'        => 'max_size[foto_new,1024]|is_image[foto_new]|mime_in[foto_new,image/jpg,image/jpeg,image/png]',
        'dok_kk_new'      => 'max_size[dok_kk_new,2048]|ext_in[dok_kk_new,pdf,jpg,png,jpeg]',
        'skl_new'         => 'max_size[skl_new,2048]|ext_in[skl_new,pdf,jpg,png,jpeg]',
        'ktp_ortu_new'    => 'max_size[ktp_ortu_new,2048]|ext_in[ktp_ortu_new,pdf,jpg,png,jpeg]',
        'akta_new'        => 'max_size[akta_new,2048]|ext_in[akta_new,pdf,jpg,png,jpeg]',
        'skkb_new'        => 'max_size[skkb_new,2048]|ext_in[skkb_new,pdf,jpg,png,jpeg]',
    ];

    // --- PESAN VALIDASI KUSTOM ---
    $validationMessages = [
        'nik' => [
            'is_unique' => 'NIK sudah terdaftar pada pendaftar lain, silakan masukkan NIK dengan benar.',
        ],
        'no_kk' => [
            'is_unique' => 'Nomor KK sudah terdaftar pada pendaftar lain, silakan masukkan Nomor KK dengan benar.',
        ],
    ];

    // Lakukan validasi dengan pesan kustom
    if (!$this->validate($rules, $validationMessages)) {
        // Gabungkan semua pesan error menjadi satu string untuk ditampilkan di alert flashdata
        $errors = $this->validator->getErrors();
        $errorString = implode(', ', array_values($errors));

        return redirect()->to('/pendaftaran/bukti')->with('update_error', 'Gagal memperbarui data: ' . $errorString);
    }

    // 3. Siapkan data baru dan proses upload file baru
    $dataToUpdate = [
        'id'              => $existingData['id'],
        'nama_lengkap'    => $this->request->getPost('nama_lengkap'),
        'nama_panggilan'  => $this->request->getPost('nama_panggilan'),
        'tempat_lahir'    => $this->request->getPost('tempat_lahir'),
        'tanggal_lahir'   => $this->request->getPost('tanggal_lahir'),
        'jenis_kelamin'   => $this->request->getPost('jenis_kelamin'),
        'alamat'          => $this->request->getPost('alamat'),
        'tinggal_bersama' => $this->request->getPost('tinggal_bersama'),
        'asal_sekolah'    => $this->request->getPost('asal_sekolah'),
        'nik'             => $this->request->getPost('nik'),
        'no_kk'           => $this->request->getPost('no_kk'),
        'no_hp'           => $this->request->getPost('no_hp'),
        'status'          => 'Menunggu Konfirmasi',
        'alasan_penolakan' => null,
    ];

    // Definisikan file fields baru dengan nama input baru
    $fileFields = [
        'foto_new'     => 'foto_path',
        'dok_kk_new'   => 'kk_path',
        'skl_new'      => 'skl_path',
        'ktp_ortu_new' => 'ktp_ayah_path',
        'akta_new'     => 'akta_path',
        'skkb_new'     => 'skkb_path',
    ];
    $uploadPaths = [
        'foto_new'     => 'uploads/foto',
        'dok_kk_new'   => 'uploads/dokumen',
        'skl_new'      => 'uploads/dokumen',
        'ktp_ortu_new' => 'uploads/dokumen',
        'akta_new'     => 'uploads/dokumen',
        'skkb_new'     => 'uploads/dokumen',
    ];

    foreach ($fileFields as $inputName => $dbColumn) {
        $file = $this->request->getFile($inputName);
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Logika Hapus file lama (disarankan, tetapi diabaikan di sini untuk fokus perbaikan validasi)

            $newName = $file->getRandomName();
            if ($file->move($uploadPaths[$inputName], $newName)) {
                $dataToUpdate[$dbColumn] = $newName;
            } else {
                log_message('error', 'Gagal mengupload file update ' . $inputName);
                return redirect()->to('/pendaftaran/bukti')->with('error', 'Gagal mengupload file: ' . $inputName);
            }
        }
    }

    // 4. Update data ke database
    if ($this->pendaftarModel->save($dataToUpdate)) {
        return redirect()->to('/pendaftaran/bukti')->with('success', 'Data pendaftaran berhasil diperbarui. Status direset menjadi Menunggu Konfirmasi.');
    } else {
        return redirect()->to('/pendaftaran/bukti')->with('error', 'Gagal memperbarui data pendaftaran. Silakan coba lagi.');
    }
}

    // Halaman sukses
    public function success()
    {
        return view('pendaftaran/success', ['title' => 'Pendaftaran Berhasil']);
    }

    // Menampilkan bukti pendaftaran
    public function bukti()
    {
        $pendaftar = $this->pendaftarModel->getPendaftarByUserId(session()->get('id'));

        if (empty($pendaftar)) {
            // Jika data tidak ditemukan, mungkin user belum mendaftar
            return redirect()->to('/pendaftaran')->with('error', 'Anda belum mengisi formulir pendaftaran.');
        }

        // Kirim juga data flash error update, jika ada
        $updateError = session()->getFlashdata('update_error');

        return view('pendaftaran/bukti', [
            'title' => 'Bukti Pendaftaran',
            'pendaftar' => $pendaftar,
            'updateError' => $updateError ?? null // Kirim error update
        ]);
    }

    /**
     * Method untuk generate dan download PDF
     */
    public function downloadPDF()
    {
        // 1. Ambil data pendaftar
        $pendaftar = $this->pendaftarModel->getPendaftarByUserId(session()->get('id'));

        if (!$pendaftar) {
            return redirect()->to('/pendaftaran/bukti')->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        // 2. Siapkan path logo untuk di-embed
        $logoPath = FCPATH . 'assets/img/logo-cisarua-girang.png';
        if (!file_exists($logoPath)) {
             return redirect()->back()->with('error', 'File logo tidak ditemukan. Hubungi administrator.');
        }
        $logoData = base64_encode(file_get_contents($logoPath));
        $logoSrc = 'data:image/png;base64,' . $logoData;

        // 3. Render view PDF ke dalam variabel HTML
        $data['pendaftar'] = $pendaftar;
        $data['logoPath'] = $logoSrc;
        $html = view('pendaftaran/bukti_pdf', $data);

        // 4. Konfigurasi Dompdf
        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $pdf->setPaper([0, 0, 612.00, 936.00], 'portrait'); // Ukuran F4

        // 5. Render HTML menjadi PDF
        $pdf->render();

        // 6. Tentukan nama file dan paksa download
        $filename = 'Bukti-Pendaftaran-' . url_title($pendaftar['nama_lengkap'], '-', true) . '.pdf';
        $pdf->stream($filename, ['Attachment' => true]);
    }
}

