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
                    ->join('akun1s', 'akun1s.id_akun1 = permintaan_pembelian.pemohon') // Pemohon diambil dari permintaan_pembelian
                    ->findAll();
    }
    public function approveRequest($id_persetujuan)
    {
        // Perbarui status persetujuan menjadi "Approved"
        $updateStatus = $this->update($id_persetujuan, ['status' => 'Approved']);
        
        if ($updateStatus) {
            log_message('debug', "Status persetujuan ID $id_persetujuan berhasil diperbarui menjadi 'Approved'.");
        } else {
            log_message('error', "Gagal memperbarui status persetujuan ID $id_persetujuan.");
            return false;
        }

        // Tambahkan record ke tabel purchase_order
        $db = \Config\Database::connect();
        $builder = $db->table('purchase_order');

        $insertData = [
            'id_persetujuan' => $id_persetujuan,
            'keterangan' => '', // Kosongkan dulu untuk diisi nanti
            'penanggung_jawab' => '', // Kosongkan dulu untuk diisi nanti
            'supplier' => '' // Kosongkan dulu untuk diisi nanti
        ];

        $insertResult = $builder->insert($insertData);

        if ($insertResult) {
            log_message('debug', "Data Purchase Order untuk ID persetujuan $id_persetujuan berhasil ditambahkan.");
            return true;
        } else {
            log_message('error', "Gagal menambahkan data Purchase Order untuk ID persetujuan $id_persetujuan.");
            return false;
        }
    }


}
