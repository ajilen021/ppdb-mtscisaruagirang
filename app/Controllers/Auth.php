<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;

class Auth extends BaseController
{
    protected $userModel;
    /**
     * @var array
     */
    // Tambahkan helper 'text' untuk membuat token acak
    protected $helpers = ['form', 'text'];

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        // Jika sudah login, redirect ke home
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        return view('auth/login', ['title' => 'Login']);
    }

    public function register()
    {
        // Jika sudah login, redirect ke home
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        return view('auth/register', ['title' => 'Register']);
    }

    public function attemptRegister()
    {
        // $userModel = new UserModel(); // Sudah ada di constructor
        $data = [
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'pass_confirm' => $this->request->getPost('pass_confirm'),
        ];

        // Validasi
        $rules = [
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'pass_confirm' => 'required|matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // --- PERUBAHAN DIMULAI DI SINI ---

        // 1. Buat token verifikasi unik
        $token = random_string('alnum', 32);

        // 2. Siapkan data untuk disimpan (termasuk token)
        $userData = [
            'email' => $data['email'],
            'password' => $data['password'], // Password akan di-hash oleh Model
            'verification_token' => $token,
            'is_verified' => 0 // Set default 0
        ];

        // 3. Simpan data
        if ($this->userModel->save($userData)) {
            // 4. Jika simpan berhasil, kirim email verifikasi
            $this->sendVerificationEmail($data['email'], $token);

            // 5. Ubah pesan sukses
            return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan cek email Anda untuk verifikasi.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mendaftar. Silakan coba lagi.');
        }
    }

    /**
     * Fungsi helper baru untuk mengirim email verifikasi
     */
    private function sendVerificationEmail($toEmail, $token)
    {
        $email = \Config\Services::email(); // Muat service email
        $config = config('Email'); // Ambil config email yang sudah Anda buat

        $verificationLink = site_url('verify-email?token=' . $token);

        $email->setFrom($config->fromEmail, $config->fromName);
        $email->setTo($toEmail);
        $email->setSubject('Verifikasi Akun PPDB MTs Cisarua Girang');
        
        // Buat pesan HTML
        $message = "<html><body style='font-family: Arial, sans-serif; line-height: 1.6;'>";
        $message .= "<h3 style='color: #004a99;'>Registrasi Berhasil!</h3>";
        $message .= "<p>Terima kasih telah mendaftar di PPDB MTs Cisarua Girang. Satu langkah lagi, silakan klik tombol di bawah untuk memverifikasi alamat email Anda:</p>";
        $message .= "<br>";
        $message .= "<a href='" . $verificationLink . "' style='display: inline-block; padding: 12px 20px; background-color: #007bff; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold;'>Verifikasi Email Saya</a>";
        $message .= "<br><br>";
        $message .= "<p>Jika tombol tidak berfungsi, silakan salin dan tempel link berikut di browser Anda:<br>" . $verificationLink . "</p>";
        $message .= "<hr>";
        $message .= "<p style='font-size: 0.9em; color: #777;'>Terima kasih,<br>Panitia PPDB MTs Cisarua Girang</p>";
        $message .= "</body></html>";
        
        $email->setMessage($message);

        // Kirim email
        if (!$email->send()) {
            // Jika gagal, catat di log
            log_message('error', 'Gagal mengirim email verifikasi ke ' . $toEmail . ': ' . $email->printDebugger(['headers']));
        }
    }

    /**
     * Fungsi baru untuk menangani link verifikasi dari email
     */
    public function verifyEmail()
    {
        $token = $this->request->getVar('token');
        if (empty($token)) {
            return redirect()->to('/login')->with('error', 'Token verifikasi tidak valid atau hilang.');
        }

        // Cari user berdasarkan token
        $user = $this->userModel->where('verification_token', $token)->first();

        if ($user) {
            // Token ditemukan, update user
            $updatedData = [
                'is_verified' => 1,
                'verification_token' => null // Hapus token agar tidak bisa dipakai lagi
            ];
            $this->userModel->update($user['id'], $updatedData);
            
            return redirect()->to('/login')->with('success', 'Email berhasil diverifikasi! Silakan login.');
        } else {
            // Token tidak ditemukan
            return redirect()->to('/login')->with('error', 'Token verifikasi salah atau sudah kedaluwarsa.');
        }
    }


    public function attemptLogin()
    {
        // $userModel = new UserModel(); // Sudah ada di constructor
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            
            // --- PERUBAHAN DI SINI ---
            // Cek apakah user sudah verifikasi
            if ($user['is_verified'] != 1) {
                // Jika belum, jangan biarkan login
                // Opsional: Anda bisa kirim ulang email verifikasi di sini
                // $this->sendVerificationEmail($user['email'], $user['verification_token']);
                return redirect()->back()->withInput()->with('error', 'Akun Anda belum diverifikasi. Silakan cek email Anda.');
            }
            // --- AKHIR PERUBAHAN ---

            $sessionData = [
                'id' => $user['id'],
                'email' => $user['email'],
                'isLoggedIn' => true,
            ];
            session()->set($sessionData);
            return redirect()->to('/');
        }

        return redirect()->back()->withInput()->with('error', 'Email atau password salah.');
    }

    /**
     * Method untuk logout pengguna.
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}