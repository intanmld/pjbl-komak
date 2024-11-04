<?php

namespace App\Models;
use CodeIgniter\Model;

class PermintaanPembelianModel extends Model
{
    protected $table = 'permintaan_pembelian';
    protected $primaryKey = 'id_permintaan';
    protected $allowedFields = ['no_permintaan', 'tanggal', 'pemohon', 'nama_barang', 'jumlah', 'satuan', 'harga'];

    public function getAllData()
    {
        return $this->select('permintaan_pembelian.*, akun1s.nama_akun1 as pemohon')
                    ->join('akun1s', 'akun1s.id_akun1 = permintaan_pembelian.pemohon')
                    ->findAll();
    }
}

