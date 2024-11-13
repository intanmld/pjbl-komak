<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Hash password admin
        $password = password_hash('adminnakuntansi123', PASSWORD_DEFAULT);

        // Data admin
        $data = [
            'email'    => 'admin@akutansi.com',
            'password' => $password,
            'role'     => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Menyimpan data ke tabel users
        $this->db->table('users')->insert($data);
    }
}
