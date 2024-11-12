<?php

namespace App\Controllers;

use App\Models\PurchaseOrderModel;
use App\Models\PersetujuanModel;
use App\Models\Akun1Model;
use App\Models\PermintaanPembelianModel;

class PurchaseOrder extends BaseController
{
    protected $purchaseOrderModel;
    protected $persetujuanModel;
    protected $akun1Model;
    protected $permintaanPembelianModel;

    public function __construct()
    {
        // Load model
        $this->purchaseOrderModel = new PurchaseOrderModel();
        $this->persetujuanModel = new PersetujuanModel();
        $this->permintaanPembelianModel = new PermintaanPembelianModel();
    }

    // Menampilkan daftar Purchase Order
    public function index()
    {
        // Ambil semua data purchase order dari model
        $data['purchaseOrders'] = $this->purchaseOrderModel->getAllData();
        return view('purchaseorder/index', $data);
    }

    // Fungsi untuk menambahkan purchase order setelah persetujuan disetujui
    // Fungsi untuk mengubah status persetujuan menjadi 'approved' dan menambahkan data ke purchase_order
    public function approve($id)
    {
        // Update status persetujuan menjadi "approved"
        $updateData = ['status' => 'Approved'];
        $this->persetujuanModel->update($id, $updateData);
    
        // Ambil data persetujuan yang baru saja diupdate
        $dataPersetujuan = $this->persetujuanModel->find($id);
    
        // Data untuk purchase order (bisa disesuaikan)
        $keterangan = 'Purchase Order untuk persetujuan ID ' . $dataPersetujuan['id_persetujuan'];
        $penanggungJawab = 'Admin';
        $supplier = 'Supplier XYZ'; // Dapatkan data supplier dari inputan atau sumber lainnya
    
        // Data purchase order yang akan disimpan
        $purchaseOrderData = [
            'id_persetujuan' => $dataPersetujuan['id_persetujuan'],
            'keterangan' => $keterangan,
            'penanggung_jawab' => $penanggungJawab,
            'supplier' => $supplier
        ];
    
        // Menambahkan purchase order baru setelah persetujuan disetujui
        $createResult = $this->purchaseOrderModel->insert($purchaseOrderData);
    
        // Cek apakah insert berhasil
        if ($createResult) {
            return redirect()->to('/purchaseorder')->with('message', 'Purchase Order telah dibuat!');
        } else {
            // Log error jika insert gagal
            log_message('error', 'Gagal menambah purchase order: ' . print_r($purchaseOrderData, true));
            return redirect()->to('/persetujuan')->with('error', 'Gagal membuat Purchase Order!');
        }
    }
    
    public function detail($id_po) {
        // Ambil data purchase order berdasarkan ID PO
        $purchaseOrder = $this->purchaseOrderModel->find($id_po);
    
        if (!$purchaseOrder) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Purchase Order dengan ID $id_po tidak ditemukan.");
        }
    
        // Ambil data persetujuan berdasarkan id_persetujuan yang ada di purchase order
        $persetujuan = $this->persetujuanModel->where('id_persetujuan', $purchaseOrder['id_persetujuan'])->first();
        
        // Ambil data permintaan pembelian berdasarkan id_permintaan dari persetujuan
        $permintaanPembelian = $this->permintaanPembelianModel->where('id_permintaan', $persetujuan['id_permintaan'])->first();
        
        // Ambil nama pemohon dari tabel akun1s berdasarkan pemohon di permintaan_pembelian
        $pemohon = $this->akun1Model->find($permintaanPembelian['pemohon']);
    
        // Format No PO (misal: PR-001)
        $noPoFormatted = 'PR-' . str_pad($purchaseOrder['id_po'], 3, '0', STR_PAD_LEFT);
    
        // Kirim data ke view
        return view('purchaseorder/detail', [
            'purchaseOrder' => $purchaseOrder,
            'permintaanPembelian' => $permintaanPembelian,
            'pemohon' => $pemohon,
            'persetujuan' => $persetujuan,
            'noPoFormatted' => $noPoFormatted
        ]);
    }
    
    
    public function edit($id_po) {
        $purchaseOrder = $this->purchaseOrderModel->find($id_po);
        
        if (!$purchaseOrder) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }

        return view('purchaseorder/edit', ['purchaseOrder' => $purchaseOrder]);
    }

    public function update($id_po) {
        // Ambil data dari form input
        $data = [
            'penanggung_jawab' => $this->request->getPost('penanggung_jawab'),
            'supplier' => $this->request->getPost('supplier'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        // Validasi data (opsional)
        if (!$this->validate([
            'penanggung_jawab' => 'required',
            'supplier' => 'required',
        ])) {
            return redirect()->to('purchaseorder/edit/' . $id_po)->withInput()->with('error', 'Data tidak valid!');
        }

        // Update data di database
        $this->purchaseOrderModel->update($id_po, $data);

        // Set flashdata untuk notifikasi
        session()->setFlashdata('success', 'Data berhasil diupdate');

        // Redirect kembali ke halaman index purchase order
        return redirect()->to('/purchaseorder');
    }

    // Fungsi untuk menghapus purchase order
    public function delete($id)
    {
        // Hapus data purchase order berdasarkan ID
        $this->purchaseOrderModel->deletePurchaseOrder($id);

        // Redirect setelah penghapusan berhasil
        return redirect()->to('/purchaseorder')->with('message', 'Purchase Order telah dihapus!');
    }
}
