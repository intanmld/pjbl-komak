<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePermintaanPembelianTable extends Migration
{
    public function up()
    {
        // Membuat tabel permintaan_pembelian
        $this->forge->addField([
            'id_permintaan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'no_permintaan' => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'tanggal' => [
                'type'           => 'DATE',
            ],
            'pemohon' => [
                'type'           => 'INT',
                'constraint'     => 6,
                'unsigned'       => true,
            ],
            'nama_barang' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'jumlah' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'satuan' => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'harga' => [
                'type'           => 'DECIMAL',
                'constraint'     => '15,2',
            ],
        ]);
        $this->forge->addPrimaryKey('id_permintaan');
        $this->forge->addForeignKey('pemohon', 'akun1s', 'id_akun1', 'CASCADE', 'CASCADE');
        $this->forge->createTable('permintaan_pembelian');
    }

    public function down()
    {
        // Menghapus tabel permintaan_pembelian
        $this->forge->dropTable('permintaan_pembelian');
    }
}
