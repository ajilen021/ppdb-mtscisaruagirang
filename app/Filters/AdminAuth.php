<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminAuth implements FilterInterface
{
    /**
     * This is the "before" filter, which is executed before the controller method.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah session 'isAdminLoggedIn' tidak ada atau bernilai false
        if (! session()->get('isAdminLoggedIn')) {
            // Jika belum login, paksa redirect ke halaman login admin
            return redirect()->to('/admin/login');
        }
    }

    /**
     * This is the "after" filter, which is executed after the controller method.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada aksi yang perlu dilakukan setelah controller
    }
}
