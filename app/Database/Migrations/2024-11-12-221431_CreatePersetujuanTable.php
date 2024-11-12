<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePersetujuanTable extends Migration
{
    public function up()
    {
        // Membuat tabel persetujuan
        $this->forge->addField([
            'id_persetujuan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'id_permintaan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'status' => [
                'type'           => 'ENUM',
                'constraint'     => "'Approved','Disapprove'",
                'default'        => 'Disapprove',
            ],
        ]);
        $this->forge->addPrimaryKey('id_persetujuan');
        $this->forge->addForeignKey('id_permintaan', 'permintaan_pembelian', 'id_permintaan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('persetujuan');
    }

    public function down()
    {
        // Menghapus tabel persetujuan
        $this->forge->dropTable('persetujuan');
    }
}
