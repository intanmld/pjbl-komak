<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key tabel

    // Fields yang dapat diisi
    protected $allowedFields = ['email', 'password', 'role'];

    // Untuk mengatur waktu pembuatan dan update (optional)
    protected $useTimestamps = true;

    // Validasi (optional)
    protected $validationRules = [
        'email'    => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
    ];
    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Email sudah terdaftar.',
        ],
        'password' => [
            'min_length' => 'Password harus minimal 6 karakter.',
        ],
    ];

    // Fungsi untuk memverifikasi email dan password saat login
    public function login($email, $password)
    {
        // Mencari user berdasarkan email
        $user = $this->where('email', $email)->first();

        // Jika user ditemukan dan password sesuai
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false; // Return false jika login gagal
    }
}
