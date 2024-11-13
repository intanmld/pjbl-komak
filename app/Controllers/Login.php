<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        // Jika sudah login, redirect ke halaman utama (misalnya dashboard)
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        return view('login');
    }
    public function login()
    {
        $model = new UserModel();

        // Ambil input dari form login
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Validasi email dan password
        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Set session jika login berhasil
            session()->set('isLoggedIn', true);
            session()->set('user_id', $user['id']);

            return redirect()->to('/'); // Halaman setelah login
        } else {
            session()->setFlashdata('error', 'Invalid email or password');
            return redirect()->back(); // Kembali ke halaman login
        }
    }

    public function logout()
    {
        session()->destroy(); // Hapus session untuk logout
        return redirect()->to('/login'); // Redirect ke halaman login
    }
}
