<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminUserModel; // Panggil model

class Auth extends BaseController
{
    public function login()
    {
        // 1. JIKA USER (SISWA) MASIH LOGIN
        // Cek apakah session user (bukan admin) ada
        if (session()->get('isLoggedIn')) {
            // Jika ya, kembalikan ke halaman sebelumnya dengan pesan error
            return redirect()->back()->with('error', 'Anda sedang login sebagai user. Silakan logout terlebih dahulu!');
        }

        // 2. JIKA ADMIN SUDAH LOGIN
        // Jika sudah login sebagai admin, redirect ke dashboard
        if (session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin/dashboard');
        }

        // 3. JIKA TIDAK LOGIN SEBAGAI APAPUN
        // Tampilkan halaman login admin
        return view('admin/login');
    }

    public function processLogin()
    {
        // Siapkan model dan ambil data dari form
        $adminModel = new AdminUserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Cari admin berdasarkan username
        $admin = $adminModel->where('username', $username)->first();

        // Lakukan verifikasi
        if ($admin && password_verify($password, $admin['password_hash'])) {
            // Jika berhasil, set session untuk admin
            $adminSessionData = [
                'admin_id'        => $admin['id'],
                'admin_username'  => $admin['username'],
                'isAdminLoggedIn' => true,
            ];
            session()->set($adminSessionData);

            // Redirect ke halaman dashboard admin
            return redirect()->to('/admin/dashboard');
        } else {
            // Jika gagal, kembali ke halaman login dengan pesan error
            return redirect()->back()->withInput()->with('error', 'Username atau Password salah.');
        }
    }

    // Method logout untuk admin
    public function logout()
    {
        session()->remove(['admin_id', 'admin_username', 'isAdminLoggedIn']);
        return redirect()->to('/admin/login');
    }
}

