<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PendaftarModel; // Panggil model Pendaftar
use App\Models\UserModel; // <-- 1. TAMBAHKAN INI
use PhpOffice\PhpSpreadsheet\Spreadsheet; // Panggil library Spreadsheet
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;   // Panggil library Writer Excel
use CodeIgniter\API\ResponseTrait; // Tambahkan ini untuk response JSON

class Pendaftar extends BaseController
{
    use ResponseTrait; // Aktifkan fitur response API

    protected $pendaftarModel;

    public function __construct()
    {
        $this->pendaftarModel = new PendaftarModel();
    }

    // Menampilkan halaman tabel pendaftar (View)
    public function index()
    {
        // ... (Tidak ada perubahan di sini) ...
        $data = [
            'title' => 'Data Calon Siswa',
        ];
        return view('admin/pendaftar/index', $data);
    }

    // --- METHOD UNTUK AMBIL DATA VIA AJAX (VERSI PERBAIKAN) ---
    public function getData()
    {
        // ... (Tidak ada perubahan di sini) ...
        $draw = $this->request->getPost('draw');
        $start = $this->request->getPost('start');
        $length = $this->request->getPost('length');
        $searchValue = $this->request->getPost('search')['value'] ?? ''; 
        $statusFilter = $this->request->getPost('status_filter') ?? ''; 
        $orderColumnIndex = $this->request->getPost('order')[0]['column'] ?? 1; 
        $orderColumnName = $this->request->getPost('columns')[$orderColumnIndex]['data'] ?? 'nama_lengkap'; 
        $orderDir = $this->request->getPost('order')[0]['dir'] ?? 'asc'; 

        $totalRecords = $this->pendaftarModel->countAllResults();
        $builder = $this->pendaftarModel->builder(); 

        if (!empty($searchValue)) {
            $builder->groupStart(); 
            $builder->like('nama_lengkap', $searchValue);
            $builder->orLike('asal_sekolah', $searchValue);
            $builder->orLike('status', $searchValue);
            $builder->groupEnd(); 
        }

        if (!empty($statusFilter)) {
            $builder->where('status', $statusFilter);
        }

        $builderFiltered = clone $builder;
        $totalRecordsFiltered = $builderFiltered->countAllResults();
        $builder->limit($length, $start);

        $allowedOrderColumns = ['nama_lengkap', 'asal_sekolah', 'status']; 
        if (in_array($orderColumnName, $allowedOrderColumns)) {
             $builder->orderBy($orderColumnName, $orderDir);
        } else {
             $builder->orderBy('nama_lengkap', 'asc'); 
        }

        $data = $builder->get()->getResultArray();
        $formattedData = [];
        $no = $start + 1;
        foreach ($data as $row) {
            $statusBadge = '';
            $statusClass = 'badge-secondary'; 
            if ($row['status'] == 'Diterima') { $statusClass = 'badge-success'; }
            elseif ($row['status'] == 'Ditolak') { $statusClass = 'badge-danger'; }
            elseif ($row['status'] == 'Menunggu Konfirmasi') { $statusClass = 'badge-warning'; }
            $statusBadge = '<span class="badge ' . $statusClass . '">' . esc($row['status']) . '</span>';
            
            // ... (Data attributes tidak berubah) ...
            $dataAttributes = ' data-id="' . $row['id'] . '"';
            $dataAttributes .= ' data-nama="' . esc($row['nama_lengkap']) . '"';
            $dataAttributes .= ' data-panggilan="' . esc($row['nama_panggilan']) . '"';
            $dataAttributes .= ' data-status="' . esc($row['status']) . '"';
            $dataAttributes .= ' data-alasan="' . esc($row['alasan_penolakan']) . '"';
             $dataAttributes .= ' data-sekolah="' . esc($row['asal_sekolah']) . '"';
             $dataAttributes .= ' data-ttl="' . esc($row['tempat_lahir']) . ', ' . date('d F Y', strtotime($row['tanggal_lahir'])) . '"';
             $dataAttributes .= ' data-tanggallahir="' . esc($row['tanggal_lahir']) . '"'; 
             $dataAttributes .= ' data-tempatlahir="' . esc($row['tempat_lahir']) . '"'; 
             $dataAttributes .= ' data-agama="' . esc($row['agama']) . '"';
             $dataAttributes .= ' data-kwn="' . esc($row['kewarganegaraan']) . '"';
             $dataAttributes .= ' data-anakke="' . esc($row['anak_ke']) . '"';
             $dataAttributes .= ' data-kakak="' . esc($row['jumlah_kakak']) . '"';
             $dataAttributes .= ' data-adik="' . esc($row['jumlah_adik']) . '"';
             $dataAttributes .= ' data-jk="' . esc($row['jenis_kelamin']) . '"';
             $dataAttributes .= ' data-alamat="' . esc($row['alamat']) . '"';
             $dataAttributes .= ' data-tinggal="' . esc($row['tinggal_bersama']) . '"';
             $dataAttributes .= ' data-statusmasuk="' . esc($row['status_masuk']) . '"';
             $dataAttributes .= ' data-diterimakelas="' . esc($row['diterima_kelas']) . '"';
             $dataAttributes .= ' data-tglditerima="' . ($row['tanggal_diterima'] ? date('Y-m-d', strtotime($row['tanggal_diterima'])) : '') . '"'; 
             $dataAttributes .= ' data-ayah="' . esc($row['nama_ayah']) . '"';
             $dataAttributes .= ' data-pekerjaanayah="' . esc($row['pekerjaan_ayah']) . '"';
             $dataAttributes .= ' data-ibu="' . esc($row['nama_ibu']) . '"';
             $dataAttributes .= ' data-pekerjaanibu="' . esc($row['pekerjaan_ibu']) . '"';
             $dataAttributes .= ' data-alamatortu="' . esc($row['alamat_ortu']) . '"';
             $dataAttributes .= ' data-hportu="' . esc($row['no_hp_ortu']) . '"';
             $dataAttributes .= ' data-wali="' . esc($row['nama_wali']) . '"';
             $dataAttributes .= ' data-alamatwali="' . esc($row['alamat_wali']) . '"';
             $dataAttributes .= ' data-kk="' . esc($row['no_kk']) . '"';
             $dataAttributes .= ' data-hp="' . esc($row['no_hp']) . '"';
             $dataAttributes .= ' data-nik="' . esc($row['nik']) . '"';
             $dataAttributes .= ' data-foto="' . ($row['foto_path'] ? base_url('uploads/foto/' . $row['foto_path']) : 'https://placehold.co/300x400/EFEFEF/AAAAAA&text=Foto+3x4') . '"';
             $dataAttributes .= ' data-dok_kk="' . ($row['kk_path'] ? base_url('uploads/dokumen/' . $row['kk_path']) : '') . '"';
             $dataAttributes .= ' data-dok_skl="' . ($row['skl_path'] ? base_url('uploads/dokumen/' . $row['skl_path']) : '') . '"';
             $dataAttributes .= ' data-dok_ktp_ayah="' . ($row['ktp_ayah_path'] ? base_url('uploads/dokumen/' . $row['ktp_ayah_path']) : '') . '"';
             $dataAttributes .= ' data-dok_akta="' . ($row['akta_path'] ? base_url('uploads/dokumen/' . $row['akta_path']) : '') . '"';
             $dataAttributes .= ' data-dok_skkb="' . ($row['skkb_path'] ? base_url('uploads/dokumen/' . $row['skkb_path']) : '') . '"';

            $aksi = '<button type="button" class="btn btn-info btn-xs btn-view" data-toggle="modal" data-target="#detailModal"' . $dataAttributes . '><i class="fas fa-eye"></i></button> ';
            $aksi .= '<button type="button" class="btn btn-warning btn-xs btn-edit" data-toggle="modal" data-target="#editModal"' . $dataAttributes . '><i class="fas fa-pencil-alt"></i></button> ';
            $aksi .= '<a href="' . base_url('/admin/pendaftar/delete/' . $row['id']) . '" class="btn btn-danger btn-xs btn-delete"><i class="fas fa-trash"></i></a>';

            $formattedData[] = [
                'no' => $no++,
                'nama_lengkap' => esc($row['nama_lengkap']),
                'asal_sekolah' => esc($row['asal_sekolah']),
                'status' => $statusBadge,
                'aksi' => $aksi
            ];
        }

        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,           
            'recordsFiltered' => $totalRecordsFiltered, 
            'data' => $formattedData,
            'token' => csrf_hash() 
        ];

        return $this->respond($response); 
    }

    // Menghapus data pendaftar
    public function delete($id = null)
    {
        // ... (Tidak ada perubahan di sini) ...
        if ($id === null) {
            return redirect()->to('/admin/pendaftar')->with('error', 'ID Pendaftar tidak valid.');
        }
        $pendaftar = $this->pendaftarModel->find($id);
        if (!$pendaftar) {
             return redirect()->to('/admin/pendaftar')->with('error', 'Data pendaftar tidak ditemukan.');
        }
        if ($this->pendaftarModel->delete($id)) {
            $this->hapusFileTerkait($pendaftar); 
            return redirect()->to('/admin/pendaftar')->with('success', 'Data pendaftar berhasil dihapus.');
        } else {
            return redirect()->to('/admin/pendaftar')->with('error', 'Gagal menghapus data pendaftar.');
        }
    }

    // Fungsi helper untuk menghapus file terkait
    private function hapusFileTerkait($pendaftarData)
    {
        // ... (Tidak ada perubahan di sini) ...
        $fileFields = ['foto_path', 'kk_path', 'skl_path', 'ktp_ayah_path', 'ktp_ibu_path', 'akta_path', 'skkb_path'];
        $basePaths = [
            'foto_path' => FCPATH . 'uploads/foto/',
            'default'   => FCPATH . 'uploads/dokumen/'
        ];
        foreach ($fileFields as $field) {
            if (!empty($pendaftarData[$field])) {
                $pathPrefix = $basePaths['default'];
                if ($field === 'foto_path') {
                    $pathPrefix = $basePaths['foto_path'];
                }
                $filePath = $pathPrefix . $pendaftarData[$field];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }
    }

    /**
     * 2. FUNGSI HELPER BARU UNTUK KIRIM NOTIFIKASI
     */
    private function sendNotificationEmail($pendaftarId, $status, $alasan = null)
    {
        // 1. Ambil data pendaftar
        $pendaftar = $this->pendaftarModel->find($pendaftarId);
        if (!$pendaftar) {
            log_message('error', "Gagal kirim notifikasi: Pendaftar ID {$pendaftarId} tidak ditemukan.");
            return false;
        }

        // 2. Ambil data user (untuk dapat email)
        $userModel = new UserModel();
        $user = $userModel->find($pendaftar['user_id']);
        if (!$user) {
            log_message('error', "Gagal kirim notifikasi: User ID {$pendaftar['user_id']} tidak ditemukan.");
            return false;
        }

        $userEmail = $user['email'];
        $namaSiswa = $pendaftar['nama_lengkap'];

        // 3. Siapkan Email
        $email = \Config\Services::email();
        $config = config('Email'); // Memuat config Anda

        $email->setFrom($config->fromEmail, $config->fromName);
        $email->setTo($userEmail);

        $subject = '';
        $message = "<html><body style='font-family: Arial, sans-serif; line-height: 1.6;'>";
        $message .= "Halo, <strong>" . esc($namaSiswa) . "</strong>,<br><br>";

        if ($status === 'Diterima') {
            $subject = 'Selamat! Pendaftaran Anda Diterima';
            $message .= "<p>Kami sampaikan bahwa pendaftaran Anda di PPDB MTs Cisarua Girang telah kami tinjau dan <strong>DITERIMA</strong>.</p>";
            $message .= "<p>Silakan tunggu informasi selanjutnya dari panitia mengenai langkah-langkah berikutnya, seperti daftar ulang atau pengukuran seragam.</p>";
            $message .= "<p>Anda dapat melihat kembali bukti pendaftaran Anda dengan login ke sistem.</p>";
        
        } elseif ($status === 'Ditolak') {
            $subject = 'Informasi Pendaftaran PPDB: Ditolak';
            $message .= "<p>Dengan berat hati kami sampaikan bahwa pendaftaran Anda di PPDB MTs Cisarua Girang <strong>DITOLAK</strong>.</p>";
            if (!empty($alasan)) {
                $message .= "<p><strong>Alasan:</strong> " . esc($alasan) . "</p>";
            } else {
                $message .= "<p><strong>Alasan:</strong> Tidak memenuhi kriteria yang ditentukan.</p>";
            }
            $message .= "<p>Anda dapat login kembali ke sistem untuk melihat detail, memperbaiki data, dan mengajukan ulang pendaftaran jika masih dalam masa pendaftaran.</p>";
        } else {
            // Jangan kirim email jika statusnya "Menunggu Konfirmasi"
            return false;
        }

        $message .= "<br><p style='font-size: 0.9em; color: #777;'>Terima kasih,<br>Panitia PPDB MTs Cisarua Girang</p>";
        $message .= "</body></html>";

        $email->setSubject($subject);
        $email->setMessage($message);

        // 4. Kirim
        if (!$email->send()) {
            log_message('error', 'Gagal mengirim notifikasi status ke ' . $userEmail . ': ' . $email->printDebugger(['headers']));
            return false;
        }
        return true;
    }


    // Memproses update status (Diterima/Ditolak)
    public function updateStatus()
    {
        $id = $this->request->getPost('pendaftar_id');
        $status = $this->request->getPost('status_aksi'); // 'Diterima' atau 'Ditolak'
        $alasan = $this->request->getPost('alasan_penolakan');

        if (empty($id) || !in_array($status, ['Diterima', 'Ditolak', 'Menunggu Konfirmasi'])) { // Tambah Menunggu jika perlu reset
            return redirect()->to('/admin/pendaftar')->with('error', 'Aksi status tidak valid.');
        }

        // Ambil status lama SEBELUM update
        $dataLama = $this->pendaftarModel->find($id);
        $statusLama = $dataLama['status'] ?? null;

        $data = [
            'status' => $status,
            'alasan_penolakan' => ($status === 'Ditolak') ? trim($alasan) : null // Hanya simpan alasan jika ditolak, trim spasi
        ];

        if ($this->pendaftarModel->update($id, $data)) {
            // --- 3. PANGGIL FUNGSI EMAIL DI SINI ---
            // Kirim email HANYA jika status berubah
            if ($status !== $statusLama) {
                $this->sendNotificationEmail($id, $status, $alasan);
            }
            // --- AKHIR PANGGILAN FUNGSI EMAIL ---

             $pesan = 'Status pendaftar berhasil diubah menjadi ' . $status . '.';
            return redirect()->to('/admin/pendaftar')->with('success', $pesan);
        } else {
            return redirect()->to('/admin/pendaftar')->with('error', 'Gagal memperbarui status.');
        }
    }

    // --- METHOD UNTUK FULL UPDATE DATA OLEH ADMIN ---
    public function fullUpdate()
    {
        // 1. Ambil ID
        $pendaftarId = $this->request->getPost('pendaftar_id');
        if (!$pendaftarId) {
             return redirect()->to('/admin/pendaftar')->with('error', 'ID Pendaftar tidak ditemukan.');
        }

        // Ambil status lama SEBELUM update
        $dataLama = $this->pendaftarModel->find($pendaftarId);
        $statusLama = $dataLama['status'] ?? null;

        // 2. Tentukan Aturan Validasi
        // ... (Rules validasi tidak berubah) ...
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
            'nama_ayah'       => 'required',
            'pekerjaan_ayah'  => 'required',
            'pekerjaan_ibu'   => 'required',
            'alamat_ortu'     => 'permit_empty',
            'no_hp_ortu'      => 'permit_empty|numeric|min_length[10]',
            'nama_wali'       => 'permit_empty|max_length[255]',
            'alamat_wali'     => 'permit_empty',
            'nik'             => 'required|numeric|exact_length[16]|is_unique[pendaftar.nik,id,' . $pendaftarId . ']',
            'no_kk'           => 'required|numeric|exact_length[16]|is_unique[pendaftar.no_kk,id,' . $pendaftarId . ']',
            'no_hp'           => 'required|numeric|min_length[10]',
            'status'          => 'required' 
        ];
         $validationMessages = [
            'nik' => ['is_unique' => 'NIK sudah terdaftar pada pendaftar lain.'],
            'no_kk' => ['is_unique' => 'Nomor KK sudah terdaftar pada pendaftar lain.'],
        ];

        // 3. Lakukan Validasi
        if (!$this->validate($rules, $validationMessages)) {
            $errors = $this->validator->getErrors();
            $errorString = implode('; ', array_values($errors));
            return redirect()->to('/admin/pendaftar')->with('error', 'Gagal update data: ' . $errorString);
        }

        // 4. Siapkan Data untuk Disimpan
        $dataToSave = [
            'id'              => $pendaftarId, 
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
            'status'          => $this->request->getPost('status'),
            'alasan_penolakan' => ($this->request->getPost('status') === 'Ditolak') ? $this->request->getPost('alasan_penolakan') : null,
        ];

        // 5. Simpan ke Database
        if ($this->pendaftarModel->save($dataToSave)) {
            
            // --- 4. PANGGIL FUNGSI EMAIL DI SINI ---
            $statusBaru = $dataToSave['status'];
            $alasanBaru = $dataToSave['alasan_penolakan'];
            
            // Kirim email HANYA jika status berubah
            if ($statusBaru !== $statusLama) {
                $this->sendNotificationEmail($pendaftarId, $statusBaru, $alasanBaru);
            }
            // --- AKHIR PANGGILAN FUNGSI EMAIL ---

            return redirect()->to('/admin/pendaftar')->with('success', 'Data pendaftar berhasil diperbarui.');
        } else {
            return redirect()->to('/admin/pendaftar')->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }


    // --- FUNGSI EXPORT EXCEL ---
    public function exportExcel()
    {
        // ... (Tidak ada perubahan di sini) ...
        $semuaPendaftar = $this->pendaftarModel->findAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $headers = [
            'A1' => 'No.', 'B1' => 'Nama Lengkap', 'C1' => 'Nama Panggilan', 'D1' => 'Tempat Lahir', 'E1' => 'Tanggal Lahir',
            'F1' => 'Agama', 'G1' => 'Kewarganegaraan', 'H1' => 'Anak Ke-', 'I1' => 'Jml Kakak', 'J1' => 'Jml Adik',
            'K1' => 'Jenis Kelamin', 'L1' => 'Alamat Siswa', 'M1' => 'Tinggal Bersama', 'N1' => 'Asal Sekolah',
            'O1' => 'Status Masuk', 'P1' => 'Diterima Kelas', 'Q1' => 'Tgl Diterima', 'R1' => 'Nama Ayah', 'S1' => 'Pekerjaan Ayah',
            'T1' => 'Nama Ibu', 'U1' => 'Pekerjaan Ibu', 'V1' => 'Alamat Ortu', 'W1' => 'No HP Ortu', 'X1' => 'Nama Wali',
            'Y1' => 'Alamat Wali','Z1' => 'NIK Siswa' , 'AA1' => 'No KK', 'AB1' => 'No HP Siswa', 'AC1' => 'Status Pendaftaran', 'AD1' => 'Alasan Penolakan'
        ];
        $lastHeaderColumn = 'AD'; 
        foreach($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }
        $headerStyle = [
            'font' => ['bold' => true],
            'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFFFE082']],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, 'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER, 'wrapText' => true],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]
        ];
        $sheet->getStyle('A1:'.$lastHeaderColumn.'1')->applyFromArray($headerStyle);
        $rowNumber = 2;
        $no = 1;
        foreach ($semuaPendaftar as $siswa) {
            $sheet->setCellValue('A' . $rowNumber, $no++);
            $sheet->setCellValue('B' . $rowNumber, $siswa['nama_lengkap']);
            $sheet->setCellValue('C' . $rowNumber, $siswa['nama_panggilan']);
            $sheet->setCellValue('D' . $rowNumber, $siswa['tempat_lahir']);
            if ($siswa['tanggal_lahir']) {
                 $tanggalLahirExcel = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($siswa['tanggal_lahir']);
                 $sheet->setCellValue('E' . $rowNumber, $tanggalLahirExcel);
                 $sheet->getStyle('E' . $rowNumber)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY);
            } else {
                 $sheet->setCellValue('E' . $rowNumber, '-');
            }
            $sheet->setCellValue('F' . $rowNumber, $siswa['agama']);
            $sheet->setCellValue('G' . $rowNumber, $siswa['kewarganegaraan']);
            $sheet->setCellValue('H' . $rowNumber, $siswa['anak_ke']);
            $sheet->setCellValue('I' . $rowNumber, $siswa['jumlah_kakak']);
            $sheet->setCellValue('J' . $rowNumber, $siswa['jumlah_adik']);
            $sheet->setCellValue('K' . $rowNumber, $siswa['jenis_kelamin']);
            $sheet->setCellValue('L' . $rowNumber, $siswa['alamat']);
            $sheet->setCellValue('M' . $rowNumber, $siswa['tinggal_bersama']);
            $sheet->setCellValue('N' . $rowNumber, $siswa['asal_sekolah']);
            $sheet->setCellValue('O' . $rowNumber, $siswa['status_masuk']);
            $sheet->setCellValue('P' . $rowNumber, $siswa['diterima_kelas']);
            if ($siswa['tanggal_diterima']) {
                 $tanggalDiterimaExcel = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($siswa['tanggal_diterima']);
                 $sheet->setCellValue('Q' . $rowNumber, $tanggalDiterimaExcel);
                 $sheet->getStyle('Q' . $rowNumber)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY);
            } else {
                 $sheet->setCellValue('Q' . $rowNumber, '-');
            }
            $sheet->setCellValue('R' . $rowNumber, $siswa['nama_ayah']);
            $sheet->setCellValue('S' . $rowNumber, $siswa['pekerjaan_ayah']);
            $sheet->setCellValue('T' . $rowNumber, $siswa['nama_ibu']);
            $sheet->setCellValue('U' . $rowNumber, $siswa['pekerjaan_ibu']);
            $sheet->setCellValue('V' . $rowNumber, $siswa['alamat_ortu']);
            $sheet->setCellValue('W' . $rowNumber, $siswa['no_hp_ortu']);
            $sheet->setCellValue('X' . $rowNumber, $siswa['nama_wali']);
            $sheet->setCellValue('Y' . $rowNumber, $siswa['alamat_wali']);
            $sheet->getCell('AA' . $rowNumber)->setValueExplicit($siswa['no_kk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->getCell('Z' . $rowNumber)->setValueExplicit($siswa['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('AB' . $rowNumber, $siswa['no_hp']);
            $sheet->setCellValue('AC' . $rowNumber, $siswa['status']);
            $sheet->setCellValue('AD' . $rowNumber, $siswa['alasan_penolakan']);

            $sheet->getStyle('A'.$rowNumber.':'.$lastHeaderColumn.$rowNumber)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle('A'.$rowNumber.':'.$lastHeaderColumn.$rowNumber)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP); 

            $rowNumber++;
        }

        for ($col = 'B'; $col !== 'AE'; $col++) { 
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        $sheet->getColumnDimension('A')->setWidth(5); 
        $sheet->getColumnDimension('L')->setWidth(30); 
        $sheet->getColumnDimension('V')->setWidth(30); 
        $sheet->getColumnDimension('Y')->setWidth(30); 
        $writer = new Xlsx($spreadsheet);
        $filename = 'Data-Pendaftar-PPDB-MTs-Cisarua-Girang-' . date('Y-m-d') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer->save('php://output');
        exit;
    }
}