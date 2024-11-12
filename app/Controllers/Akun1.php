<?php

namespace App\Controllers;

use App\Models\Akun1Model;

class Akun1 extends BaseController
{
    protected $akun1Model;

    public function __construct()
    {
        $this->akun1Model = new Akun1Model();
    }
    public function index()
    {
        
        $builder = $this->db->table('akun1s');
        $query = $builder->get();

        $query = $this->db->query("SELECT * FROM akun1s");
        $data['dtakun1'] = $query->getResult();
        return view('akun1/index', $data);

        // dd($query);
        // return view('akun1/index');
    }

    public function new()
    {
        return view('akun1/new');
    }
        // Menampilkan form edit berdasarkan ID
        public function edit($id)
        {
            // Mengambil data akun berdasarkan id_akun1
            $akun = $this->akun1Model->find($id); // find() akan mengembalikan objek

            $akun = $this->akun1Model->asObject()->find($id);
    
            // Jika data akun tidak ditemukan
            if (!$akun) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Akun dengan ID ' . $id . ' tidak ditemukan.');
            }
    
            // Mengirimkan data akun ke view untuk di-edit
            return view('akun1/edit', ['akun' => $akun]);
        }
        

    public function delete($id)
    {
        // Cek apakah akun ada sebelum menghapus
        $akun = $this->akun1Model->find($id);
        
        if (!$akun) {
            // Jika akun tidak ditemukan, beri pesan error
            session()->setFlashdata('error', 'Akun tidak ditemukan.');
            return redirect()->to('/akun1');
        }

        // Menggunakan flashdata untuk menunjukkan peringatan kepada user
        session()->setFlashdata('warning', 'Anda akan menghapus akun ini. Apakah Anda yakin?');

        // Hapus akun berdasarkan id_akun1
        $this->akun1Model->delete($id);

        // Set flashdata sukses setelah penghapusan
        session()->setFlashdata('success', 'Akun berhasil dihapus.');
        
        return redirect()->to('/akun1'); // Redirect kembali ke halaman utama
    }

    // Menyimpan perubahan data
    public function update($id)
    {
        // Ambil data yang dikirim dari form
        $data = [
            'kode_akun1' => $this->request->getPost('kode_akun1'),
            'nama_akun1' => $this->request->getPost('nama_akun1')
        ];

        // Update data ke database
        $this->akun1Model->update($id, $data);

        // Redirect ke halaman index akun setelah berhasil update
        return redirect()->to('/akun1');
    }
    // Menangani input data dari form create
public function create()
{
    // Menangani input data dari form
    $data = [
        'kode_akun1' => $this->request->getPost('kode_akun1'),
        'nama_akun1' => $this->request->getPost('nama_akun1'),
    ];

    // Validasi input (bisa ditambah sesuai kebutuhan)
    if (!$this->validate([
        'kode_akun1' => 'required|min_length[1]|max_length[6]',
        'nama_akun1' => 'required|min_length[3]|max_length[20]',
    ])) {
        return redirect()->to('/akun1/new')->withInput()->with('errors', $this->validator->getErrors());
    }

    // Menyimpan data ke database
    $this->akun1Model->insert($data);

    // Menambahkan pesan sukses menggunakan session flashdata
    session()->setFlashdata('success', 'Akun baru berhasil ditambahkan.');

    // Redirect ke halaman index setelah data disimpan
    return redirect()->to('/akun1');
}

}
