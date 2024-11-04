<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Permintaan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_permintaan' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'no_permintaan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'pemohon' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'nama_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'jumlah' => [
                'type'       => 'INT',
            ],
            'satuan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ]
        ]);

        // Set primary key
        $this->forge->addKey('id', true);

        // Tambahkan foreign key ke `akun1s`
        $this->forge->addForeignKey('pemohon', 'akun1s', 'id_akun1', 'CASCADE', 'CASCADE');

        // Buat tabel
        $this->forge->createTable('permintaan_pembelian');
    }

    public function down()
    {
        // Hapus tabel jika ada
        $this->forge->dropTable('permintaan_pembelian');
    }
}
