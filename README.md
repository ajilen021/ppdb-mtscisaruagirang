# Website PPDB MTs Cisarua Girang

Aplikasi Pendaftaran Peserta Didik Baru (PPDB) online untuk MTs Cisarua Girang, dibangun menggunakan CodeIgniter 4. Proyek ini dibuat sebagai bagian dari Kerja Praktik (KP) dan telah melalui revisi untuk menyertakan fitur-fitur modern seperti verifikasi email, notifikasi status, dan alur pendaftaran minimalis.

![Tangkapan Layar Dashboard Admin](httpstangkapan-layar-dashboard-admin.png)
*(Catatan: Ganti gambar di atas dengan tangkapan layar dashboard admin Anda)*

---

## 🚀 Fitur Utama

Aplikasi ini dibagi menjadi dua bagian utama: alur untuk Siswa (User) dan alur untuk Panitia (Admin).

### 👨‍🎓 Fitur Siswa (User)

* **Registrasi Akun:** Siswa mendaftar menggunakan email dan password.
* **Verifikasi Email:** Sistem otomatis mengirim email verifikasi untuk memastikan email valid sebelum login.
* **Kirim Ulang Verifikasi:** Fitur untuk mengirim ulang email verifikasi jika token kedaluwarsa atau tidak terkirim.
* **Formulir Pendaftaran Minimalis:** Sesuai revisi, siswa hanya mengisi data kontak utama (Nama, JK, Asal Sekolah, No. HP) dan meng-upload dokumen wajib.
* **Upload Dokumen:** Siswa meng-upload dokumen seperti KK, Akta, SKL, KTP Ortu, dan SKKB.
* **Halaman Status Pendaftaran:** Siswa dapat melihat status pendaftaran mereka secara *real-time* (Menunggu Konfirmasi, Diterima, Ditolak).
* **Notifikasi Alasan Penolakan:** Jika ditolak, siswa dapat melihat alasan dari admin (misal: "KK buram").
* **Perbaikan Data:** Siswa yang ditolak dapat memperbaiki/meng-upload ulang dokumen dan mengajukan kembali.
* **Unduh Bukti PDF:** Siswa dapat mengunduh bukti pendaftaran dalam format PDF.

### 👑 Fitur Panitia (Admin)

* **Login Admin:** Halaman login terpisah dan aman untuk panitia/admin.
* **Dashboard Statistik:** Menampilkan ringkasan data pendaftar (Total, Menunggu, Diterima, Ditolak) dan grafik pendaftaran harian.
* **Manajemen Data Pendaftar:**
    * **Tabel Server-Side:** Menggunakan Server-Side DataTables, mampu menangani 1.000+ data pendaftar dengan cepat tanpa membebani browser.
    * **Filter & Pencarian:** Admin dapat memfilter data berdasarkan status (misal: tampilkan hanya yang "Menunggu Konfirmasi") dan melakukan pencarian.
* **Alur Validasi & Data Entry:**
    * **Lihat Dokumen:** Admin dapat melihat dokumen yang di-upload siswa langsung dari modal detail.
    * **Validasi (Setuju/Tolak):** Admin dapat menyetujui atau menolak pendaftaran langsung dari modal.
    * **Edit Data Lengkap:** Admin memiliki **Modal Edit** khusus untuk melengkapi data siswa (NIK, TTL, Nama Ortu, dll.) berdasarkan dokumen yang telah di-upload.
* **Notifikasi Email Otomatis:** Sistem secara otomatis mengirim email notifikasi ke siswa ketika admin mengubah status pendaftaran mereka menjadi "Diterima" atau "Ditolak".
* **Ekspor ke Excel:** Fitur untuk mengunduh seluruh data pendaftar (semua kolom) ke dalam file `.xlsx` (Excel).

---

## 🛠️ Teknologi yang Digunakan

* **Framework:** CodeIgniter 4
* **Bahasa:** PHP 8.1+
* **Database:** MySQL
* **Frontend (User):** Bootstrap 5
* **Frontend (Admin):** AdminLTE 3
* **Library (Server-Side):**
    * `CodeIgniter\Email` (untuk verifikasi & notifikasi)
    * `Dompdf` (untuk generate PDF)
    * `PhpSpreadsheet` (untuk generate Excel)
    * `DataTables` (Server-Side Processing)

---

## ⚙️ Instalasi dan Konfigurasi

Berikut adalah langkah-langkah untuk menjalankan proyek ini di lingkungan lokal.

### 1. Prasyarat

* PHP 8.1 atau lebih baru
* Composer
* Web Server (XAMPP, Laragon, dll.)
* Database MySQL

### 2. Langkah Instalasi

1.  **Clone repositori:**
    ```bash
    git clone [https://github.com/username-anda/nama-repo-anda.git](https://github.com/username-anda/nama-repo-anda.git)
    cd nama-repo-anda
    ```

2.  **Install dependensi:**
    ```bash
    composer install
    ```

3.  **Konfigurasi Database:**
    * Salin file `env` menjadi `.env`.
    * Buka file `.env` dan atur variabel berikut:
        ```env
        CI_ENVIRONMENT = development

        app.baseURL = 'http://localhost:8080/'
        # Sesuaikan jika Anda menggunakan index.php
        app.indexPage = 'index.php' 

        database.default.hostname = localhost
        database.default.database = nama_database_anda
        database.default.username = root
        database.default.password = 
        ```
    * Impor file `.sql` Anda ke database `nama_database_anda` melalui phpMyAdmin.

4.  **Konfigurasi Email (Sangat Penting):**
    * Buka file `app/Config/Email.php`.
    * Isi kredensial SMTP Anda (direkomendasikan menggunakan "Sandi Aplikasi" Gmail).
        ```php
        public string $fromEmail  = 'email-anda@gmail.com';
        public string $fromName   = 'Panitia PPDB MTs Cisarua Girang';
        public string $SMTPHost   = 'smtp.gmail.com';
        public string $SMTPUser   = 'email-anda@gmail.com';
        public string $SMTPPass   = '16-digit-sandi-aplikasi-anda';
        public int $SMTPPort      = 465;
        public string $SMTPCrypto = 'ssl';
        public string $mailType   = 'html';
        ```

5.  **Buat Folder Upload:**
    * Di dalam folder `public/`, buat dua folder baru:
        * `uploads`
        * `uploads/foto`
        * `uploads/dokumen`
    * Pastikan folder `public/uploads` memiliki izin tulis (writable).

6.  **Jalankan Aplikasi:**
    ```bash
    php spark serve
    ```
    * Aplikasi akan berjalan di `http://localhost:8080` (atau sesuai `app.baseURL` Anda).

### 3. Akun Admin Bawaan

Untuk login ke panel admin, Anda mungkin perlu membuat data admin secara manual di tabel `admin_users` di database Anda.

* **Username:** (sesuai yang Anda masukkan)
* **Password:** (Gunakan *password hash* yang di-generate oleh PHP. Anda bisa membuat skrip `register_admin.php` sederhana untuk ini).

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).
