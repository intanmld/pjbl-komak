<?php

namespace App\Models;
use CodeIgniter\Model;

class PersetujuanModel extends Model
{
    protected $table = 'persetujuan';
    protected $primaryKey = 'id_persetujuan';
    protected $allowedFields = ['id_permintaan', 'status'];

    public function getAllData()
    {
        return $this->select('persetujuan.*, permintaan_pembelian.no_permintaan, permintaan_pembelian.tanggal, permintaan_pembelian.nama_barang, permintaan_pembelian.jumlah, permintaan_pembelian.satuan, permintaan_pembelian.harga, akun1s.nama_akun1 as pemohon')
                    ->join('permintaan_pembelian', 'permintaan_pembelian.id_permintaan = persetujuan.id_permintaan')
                    ->join('akun1s', 'akun1s.id_akun1 = permintaan_pembelian.pemohon')
                    ->findAll();
    }
}
