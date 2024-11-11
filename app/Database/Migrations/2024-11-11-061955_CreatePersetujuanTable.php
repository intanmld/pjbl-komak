<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePersetujuanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_persetujuan' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_permintaan' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Approved', 'Disapprove'],
                'default'    => 'Disapprove',
            ],
        ]);

        $this->forge->addKey('id_persetujuan', true);
        
        // Tambahkan foreign key
        $this->forge->addForeignKey('id_permintaan', 'permintaan_pembelian', 'id_permintaan', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('persetujuan');
    }

    public function down()
    {
        $this->forge->dropTable('persetujuan');
    }
}
