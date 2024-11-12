<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAkun1sTable extends Migration
{
    public function up()
    {
        // Membuat tabel akun1s
        $this->forge->addField([
            'id_akun1' => [
                'type'           => 'INT',
                'constraint'     => 6,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_akun1' => [
                'type'           => 'VARCHAR',
                'constraint'     => '6',
            ],
            'nama_akun1' => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
            ],
        ]);
        $this->forge->addPrimaryKey('id_akun1');
        $this->forge->createTable('akun1s');
    }

    public function down()
    {
        // Menghapus tabel akun1s
        $this->forge->dropTable('akun1s');
    }
}
