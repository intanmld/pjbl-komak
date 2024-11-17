<?php

namespace App\Models;

use CodeIgniter\Model;

class PurchaseOrderModel extends Model
{
    protected $table = 'purchase_order';
    protected $primaryKey = 'id_po';
    protected $allowedFields = ['id_persetujuan', 'keterangan', 'penanggung_jawab', 'supplier'];

    // Fungsi untuk mendapatkan data purchase order dengan detail permintaan pembelian
    public function getAllData()
    {
        return $this->select('purchase_order.*, persetujuan.id_persetujuan, permintaan_pembelian.pemohon, akun1s.nama_akun1, permintaan_pembelian.no_permintaan, permintaan_pembelian.tanggal, permintaan_pembelian.nama_barang, permintaan_pembelian.jumlah, permintaan_pembelian.satuan, permintaan_pembelian.harga')
            ->join('persetujuan', 'purchase_order.id_persetujuan = persetujuan.id_persetujuan')
            ->join('permintaan_pembelian', 'persetujuan.id_permintaan = permintaan_pembelian.id_permintaan')
            ->join('akun1s', 'permintaan_pembelian.pemohon = akun1s.id_akun1') // Join ke tabel akun1s
            ->findAll();
    }
    // Model PurchaseOrderModel.php
    public function createPurchaseOrder($idPersetujuan, $keterangan, $penanggungJawab, $supplier)
    {
        // Pastikan data yang dimasukkan sesuai dengan format yang diinginkan
        $data = [
            'id_persetujuan' => $idPersetujuan,
            'keterangan' => $keterangan,
            'penanggung_jawab' => $penanggungJawab,
            'supplier' => $supplier
        ];

        // Simpan data ke dalam tabel purchase_order
        return $this->insert($data);
    }
    public function getDataById($id_po)
    {
        return $this->db->table('purchase_order')
            ->select('purchase_order.*, persetujuan.id_persetujuan, permintaan_pembelian.pemohon, akun1s.nama_akun1, permintaan_pembelian.no_permintaan, permintaan_pembelian.tanggal, permintaan_pembelian.nama_barang, permintaan_pembelian.jumlah, permintaan_pembelian.satuan, permintaan_pembelian.harga')
            ->join('persetujuan', 'purchase_order.id_persetujuan = persetujuan.id_persetujuan')
            ->join('permintaan_pembelian', 'persetujuan.id_permintaan = permintaan_pembelian.id_permintaan')
            ->join('akun1s', 'permintaan_pembelian.pemohon = akun1s.id_akun1') // Join ke tabel akun1s
            ->where('id_po', $id_po)
            ->get()
            ->getRowArray();
    }
}
