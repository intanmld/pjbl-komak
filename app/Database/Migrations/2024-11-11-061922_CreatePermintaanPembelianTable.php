<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePermintaanPembelianTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_permintaan' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'no_permintaan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'nama_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'jumlah' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'satuan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'pemohon' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
        ]);

        $this->forge->addKey('id_permintaan', true);
        $this->forge->createTable('permintaan_pembelian');
    }

    public function down()
    {
        $this->forge->dropTable('permintaan_pembelian');
    }
}
