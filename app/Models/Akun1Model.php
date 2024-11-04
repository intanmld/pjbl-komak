<?php

namespace App\Models;
use CodeIgniter\Model;

class Akun1Model extends Model
{
    protected $table = 'akun1s';
    protected $primaryKey = 'id_akun1';  // Ganti 'id' menjadi 'id_akun1'
    protected $allowedFields = ['kode_akun1', 'nama_akun1'];  // Pastikan field yang benar
}

