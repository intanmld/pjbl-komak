<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAknDatabase extends Migration
{
    public function up()
    {
        // Membuat database 'akn'
        $db = \Config\Database::connect();
        $db->query('CREATE DATABASE IF NOT EXISTS akn');
    }

    public function down()
    {
        // Menghapus database 'akn'
        $db = \Config\Database::connect();
        $db->query('DROP DATABASE IF EXISTS akn');
    }
}
