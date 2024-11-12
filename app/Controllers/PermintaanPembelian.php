<?php

namespace App\Controllers;

use App\Models\PermintaanPembelianModel;
use App\Models\Akun1Model;
use App\Models\PersetujuanModel;

class PermintaanPembelian extends BaseController
{
    protected $permintaanModel;
    protected $akun1Model;
    protected $persetujuanModel;

    public function __construct()
    {
        $this->permintaanModel = new PermintaanPembelianModel();
        $this->akun1Model = new Akun1Model();
        $this->persetujuanModel = new PersetujuanModel();
    }

    public function index()
    {
        // Ambil semua data permintaan
        $permintaanList = $this->permintaanModel->getAllData();

        // Format tanggal ke day-month-year
        foreach ($permintaanList as &$permintaan) {
            if (isset($permintaan['tanggal'])) {
                $permintaan['tanggal'] = (new \DateTime($permintaan['tanggal']))->format('d-m-Y');
            }
        }
        
        $data['permintaan'] = $permintaanList;

        return view('permintaanpembelian/index', $data);
    }

    public function create()
    {
        $data['pemohon_list'] = $this->akun1Model->findAll();
        return view('permintaanpembelian/create', $data);
    }

    public function store()
    {
        // Simpan data ke tabel permintaan_pembelian
        $this->permintaanModel->save([
            'no_permintaan' => $this->request->getPost('no_permintaan'),
            'tanggal' => $this->request->getPost('tanggal'),
            'pemohon' => $this->request->getPost('pemohon'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'jumlah' => $this->request->getPost('jumlah'),
            'satuan' => $this->request->getPost('satuan'),
            'harga' => $this->request->getPost('harga'),
        ]);

        $id_permintaan = $this->permintaanModel->getInsertID();

        $this->persetujuanModel->save([
            'id_permintaan' => $id_permintaan,
            'status' => 'Disapprove'
        ]);

        return redirect()->to('/permintaanpembelian');
    }

    public function edit($id)
    {
        $data['permintaan'] = $this->permintaanModel->find($id);
        $data['pemohon_list'] = $this->akun1Model->findAll();
        return view('permintaanpembelian/edit', $data);
    }

    public function update($id)
    {
        $this->permintaanModel->update($id, [
            'no_permintaan' => $this->request->getPost('no_permintaan'),
            'tanggal' => $this->request->getPost('tanggal'),
            'pemohon' => $this->request->getPost('pemohon'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'jumlah' => $this->request->getPost('jumlah'),
            'satuan' => $this->request->getPost('satuan'),
            'harga' => $this->request->getPost('harga'),
        ]);

        return redirect()->to('/permintaanpembelian');
    }

    public function delete($id)
    {
        // Cek apakah permintaan terkait sudah di-approve di tabel persetujuan
        $persetujuan = $this->persetujuanModel->where('id_permintaan', $id)->first();
        
        if ($persetujuan && $persetujuan['status'] === 'Approved') {
            // Jika sudah di-approve, set flashdata error
            session()->setFlashdata('error', 'Tidak bisa delete, Data sudah di Approved');
        } else {
            // Jika belum di-approve, hapus data
            $this->permintaanModel->delete($id);
            session()->setFlashdata('success', 'Data berhasil dihapus');
        }
        
        // Redirect ke halaman permintaan pembelian
        return redirect()->to('/permintaanpembelian');
    }
    
}
