<?php

namespace App\Controllers;
use App\Models\PersetujuanModel;
use App\Models\PermintaanPembelianModel;

class Persetujuan extends BaseController
{
    protected $persetujuanModel;
    protected $permintaanModel;

    public function __construct()
    {
        $this->persetujuanModel = new PersetujuanModel();
        $this->permintaanModel = new PermintaanPembelianModel();
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
        $this->persetujuanModel->update($id_persetujuan, [
            'status' => $this->request->getPost('status')
        ]);

        return redirect()->to('/persetujuan');
    }
    public function delete($id_persetujuan)
    {
        $persetujuan = $this->persetujuanModel->find($id_persetujuan);

        $this->permintaanModel->delete($persetujuan['id_permintaan']);

        $this->persetujuanModel->delete($id_persetujuan);

        return redirect()->to('/persetujuan');
    }
}
