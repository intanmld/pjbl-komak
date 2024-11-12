<?php

namespace App\Controllers;

use App\Models\PersetujuanModel;
use App\Models\PermintaanPembelianModel;
use App\Models\PurchaseOrderModel;  // Tambahkan ini untuk menggunakan model PurchaseOrder

class Persetujuan extends BaseController
{
    protected $persetujuanModel;
    protected $permintaanModel;
    protected $purchaseOrderModel;  // Tambahkan properti model untuk purchase_order

    public function __construct()
    {
        // Inisialisasi semua model yang digunakan
        $this->persetujuanModel = new PersetujuanModel();
        $this->permintaanModel = new PermintaanPembelianModel();
        $this->purchaseOrderModel = new PurchaseOrderModel();  // Inisialisasi PurchaseOrderModel
    }

    public function index()
    {
        $data['persetujuan'] = $this->persetujuanModel->getAllData();
        return view('persetujuan/index', $data);
    }



    public function edit($id_persetujuan)
    {
        $data['persetujuan'] = $this->persetujuanModel->find($id_persetujuan);
        return view('persetujuan/edit', $data);
    }

    public function update($id_persetujuan)
    {
        // Ambil data persetujuan untuk memeriksa status saat ini
        $currentData = $this->persetujuanModel->find($id_persetujuan);

        if ($currentData['status'] === 'Approved') {
            // Jika status sudah approved, tampilkan pesan peringatan
            session()->setFlashdata('error', 'Tidak bisa diubah, data sudah di Approved');
            return redirect()->to('/persetujuan');
        }

        // Update status jika belum approved
        $status = $this->request->getPost('status');
        $this->persetujuanModel->update($id_persetujuan, [
            'status' => $status
        ]);

        // Cek jika status baru adalah 'Approved'
        if ($status === 'Approved') {
            // Ambil data persetujuan berdasarkan id_persetujuan
            $persetujuan = $this->persetujuanModel->find($id_persetujuan);
            if (!$persetujuan) {
                session()->setFlashdata('error', 'Persetujuan tidak ditemukan');
                return redirect()->to('/persetujuan');
            }

            // Ambil data permintaan_pembelian berdasarkan id_permintaan dari persetujuan
            $permintaanPembelian = $this->permintaanModel->find($persetujuan['id_permintaan']);
            if (!$permintaanPembelian) {
                session()->setFlashdata('error', 'Permintaan Pembelian tidak ditemukan');
                return redirect()->to('/persetujuan');
            }

            // Siapkan data untuk purchase_order
            $purchaseOrderData = [
                'id_persetujuan' => $id_persetujuan,
                'keterangan' => '',  // Dikosongkan dulu sesuai permintaan
                'penanggung_jawab' => '',  // Dikosongkan dulu sesuai permintaan
                'supplier' => ''  // Dikosongkan dulu sesuai permintaan
            ];

            // Proses insert ke tabel purchase_order
            $inserted = $this->purchaseOrderModel->insert($purchaseOrderData);

            if ($inserted) {
                session()->setFlashdata('success', 'Status berhasil diubah dan Purchase Order berhasil dibuat');
            } else {
                session()->setFlashdata('error', 'Status berhasil diubah, namun gagal membuat Purchase Order');
            }
        } else {
            session()->setFlashdata('success', 'Status berhasil diubah');
        }

        return redirect()->to('/persetujuan');
    }

    public function delete($id_persetujuan)
    {
        // Temukan data persetujuan berdasarkan id
        $persetujuan = $this->persetujuanModel->find($id_persetujuan);
    
        // Cek jika statusnya 'Approved', jika iya, jangan izinkan penghapusan
        if ($persetujuan['status'] === 'Approved') {
            return redirect()->to('/persetujuan')->with('error', 'Tidak bisa delete, Data sudah di Approved');
        }
    
        // Jika statusnya bukan 'Approved', lakukan penghapusan
        $this->persetujuanModel->delete($id_persetujuan);
    
        // Hapus data permintaan_pembelian yang terkait dengan persetujuan yang dihapus
        $this->permintaanModel->delete($persetujuan['id_permintaan']);
    
        // Redirect kembali dengan pesan sukses
        return redirect()->to('/persetujuan')->with('success', 'Data persetujuan dan permintaan pembelian berhasil dihapus');
    }
    
}
