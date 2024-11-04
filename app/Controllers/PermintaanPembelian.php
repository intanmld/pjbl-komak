<?php

namespace App\Controllers;
use App\Models\PermintaanPembelianModel;
use App\Models\Akun1Model;

class PermintaanPembelian extends BaseController
{
    protected $permintaanModel;
    protected $akun1Model;

    public function __construct()
    {
        $this->permintaanModel = new PermintaanPembelianModel();
        $this->akun1Model = new Akun1Model();
    }

    public function index()
    {
        $data['permintaan'] = $this->permintaanModel->getAllData();
        return view('permintaanpembelian/index', $data);
    }

    public function create()
    {
        $data['pemohon_list'] = $this->akun1Model->findAll();
        return view('permintaanpembelian/create', $data);
    }

    public function store()
    {
        $this->permintaanModel->save([
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
    // Controller/PermintaanPembelian.php

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
        $this->permintaanModel->delete($id);
        return redirect()->to('/permintaanpembelian');
    }

}
