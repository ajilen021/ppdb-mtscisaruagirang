<?php

namespace App\Controllers;

use App\Models\PendaftarModel;

class Home extends BaseController
{
    public function index()
    {
        $pendaftarModel = new PendaftarModel();
        $data = [
            'title' => 'PPDB MTs Cisarua Girang',
            'pendaftar' => null
        ];

        // Cek jika user sudah login dan sudah mendaftar
        if (session()->get('isLoggedIn')) {
            $data['pendaftar'] = $pendaftarModel->getPendaftarByUserId(session()->get('id'));
        }

        return view('home', $data);
    }
}
