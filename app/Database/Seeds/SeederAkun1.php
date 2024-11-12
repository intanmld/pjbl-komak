<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeederAkun1 extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kode_akun1' => 1,
                'nama_akun1'    => 'Aziz',
            ],
            [
                'kode_akun1' => 2,
                'nama_akun1'    => 'Nyimas',
            ],
            [
                'kode_akun1' => 3,
                'nama_akun1'    => 'Liana',
            ],
            [
                'kode_akun1' => 4,
                'nama_akun1'    => 'Resty',
            ],
            [
                'kode_akun1' => 5,
                'nama_akun1'    => 'Intan',
            ],
        ];
        // Simple Queries
        #$this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

        // Using Query Builder
        #$this->db->table('akun1s')->insert($data);
        $this->db->table('akun1s')->insertBatch($data);
    }
}
