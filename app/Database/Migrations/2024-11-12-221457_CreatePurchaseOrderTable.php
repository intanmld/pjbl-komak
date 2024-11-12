<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePurchaseOrderTable extends Migration
{
    public function up()
    {
        // Membuat tabel purchase_order
        $this->forge->addField([
            'id_po' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'id_persetujuan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'keterangan' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
            ],
            'penanggung_jawab' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true,
            ],
            'supplier' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'null'           => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id_po');
        $this->forge->addForeignKey('id_persetujuan', 'persetujuan', 'id_persetujuan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('purchase_order');
    }

    public function down()
    {
        // Menghapus tabel purchase_order
        $this->forge->dropTable('purchase_order');
    }
}
