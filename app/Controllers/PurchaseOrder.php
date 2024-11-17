<?php

namespace App\Controllers;

use App\Models\PurchaseOrderModel;
use App\Models\PersetujuanModel;
use App\Models\Akun1Model;
use App\Models\PermintaanPembelianModel;
use TCPDF;

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
        $this->akun1Model = new Akun1Model();
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

    public function detail($id_po)
    {
        // Ambil data purchase order berdasarkan ID PO
        $purchaseOrder = $this->purchaseOrderModel->find($id_po);

        if (!$purchaseOrder) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Purchase Order dengan ID $id_po tidak ditemukan.");
        }

        // Ambil data persetujuan berdasarkan id_persetujuan yang ada di purchase order
        $persetujuan = $this->persetujuanModel->where('id_persetujuan', $purchaseOrder['id_persetujuan'])->first();

        // Ambil data permintaan pembelian berdasarkan id_permintaan dari persetujuan
        $permintaanPembelian = $this->permintaanPembelianModel
            ->select('id_permintaan, no_permintaan, tanggal, nama_barang, jumlah, satuan, harga') // Pastikan mengambil no_permintaan
            ->where('id_permintaan', $persetujuan['id_permintaan'])
            ->first();

        // Ambil data permintaan pembelian berdasarkan id_permintaan dari persetujuan
        $permintaanPembelian = $this->permintaanPembelianModel->where('id_permintaan', $persetujuan['id_permintaan'])->first();

        // Ambil nama pemohon dari tabel akun1s berdasarkan pemohon di permintaan_pembelian
        $pemohon = $this->akun1Model->find($permintaanPembelian['pemohon']);

        // Format No PO (misal: PO-001)
        $noPoFormatted = 'PO-' . str_pad($purchaseOrder['id_po'], 3, '0', STR_PAD_LEFT);

        $penanggungJawab = $this->akun1Model->find($purchaseOrder['penanggung_jawab']);

        $tanggalFormatted = (new \DateTime($permintaanPembelian['tanggal']))->format('d-m-Y');

        // Kirim data ke view
        return view('purchaseorder/detail', [
            'purchaseOrder' => $purchaseOrder,
            'permintaanPembelian' => $permintaanPembelian,
            'pemohon' => $pemohon,
            'persetujuan' => $persetujuan,
            'noPoFormatted' => $noPoFormatted,
            'tanggalFormatted' => $tanggalFormatted,
            'penanggungJawab' => $penanggungJawab
        ]);
    }


    public function edit($id_po)
    {
        $purchaseOrder = $this->purchaseOrderModel->find($id_po);

        if (!$purchaseOrder) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }

        // Mengambil daftar akun1 untuk dropdown penanggung jawab
        $akun1List = $this->akun1Model->findAll();

        // Kirim data ke view, termasuk daftar akun1
        return view('purchaseorder/edit', [
            'purchaseOrder' => $purchaseOrder,
            'akun1List' => $akun1List
        ]);
    }


    public function update($id_po)
    {
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

    public function purchaseorderpdf($id_po)
    {
        $data['purchaseOrder'] = $purchaseOrder  = $this->purchaseOrderModel->getDataById($id_po);
        if (empty($data['purchaseOrder'])) {
            // Optionally handle case when no data is found for the given id_po
            return redirect()->back()->with('error', 'No data found for this PO.');
        }

        $html = view('purchaseorder/purchaseorderpdf', $data);

        $pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        // set margins
        $pdf->SetMargins(30, 4, 3);
        // set font
        $pdf->SetFont('helvetica', '', 8);
        // add a page
        $pdf->AddPage();
        // Print text using writeHTMLCell()
        $pdf->writeHTML($html, true, false, true, false, '');

        $this->response->setContentType('application/pdf');
        $pdf->Output('purchaseorder.pdf', 'I');
    }
}
