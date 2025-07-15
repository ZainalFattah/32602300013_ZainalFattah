<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use CodeIgniter\HTTP\ResponseInterface;

class Crud extends BaseController
{
    protected $db;
    public function __construct()
    {
        $this->db = new MahasiswaModel();
    }
    public function index()
    {   
        $all = $this->db->findAll();
        // zainal fattah
        $data = [
            'mahasiswa' => $all
        ];

        return view('crud/view', $data);
    }

    public function tambah()
    {
        if(isset($_POST['nim'])){

            $nim = $_POST['nim'];
            $nama = $_POST['nama'];
            $prodi = $_POST['prodi'];
            $universitas = $_POST['universitas'];
            $no_hp = $_POST['no_hp'];

            $upload = [
                'nim' => $nim,
                'nama' => $nama,
                'prodi' => $prodi,
                'universitas' => $universitas,
                'no_hp' => $no_hp
            ];

            $this->db->insert($upload);

            return redirect()->to(base_url('/crud'));
        }else{
            return view('crud/upload');
        }
        
    }

    public function edit($id)
    {
        $nim = $id;
        $a = $this->db->find($nim);
        $data = [
            'edit' => $a
        ];
        return view('crud/edit', $data);
    }

    public function editan()
    {
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $prodi = $_POST['prodi'];
        $universitas = $_POST['universitas'];
        $no_hp = $_POST['no_hp'];
        $newNim = $_POST['newNim'];
        $newNama = $_POST['newNama'];
        $newProdi = $_POST['newProdi'];
        $newUniversitas = $_POST['newUniversitas'];
        $new_no_hp = $_POST['new_no_hp'];
        $this->db->where('nim', $nim)
            ->set('nim', $newNim)
            ->set('nama', $newNama)
            ->set('prodi', $newProdi)
            ->set('universitas', $newUniversitas)
            ->set('no_hp', $new_no_hp)
            ->update();
        return redirect()->to(base_url('/crud'));
    }

    public function hapus($id)
    {
        $nim = $id;
        $this->db->delete($nim);
        return redirect()->to(base_url('/crud'));
    }
}
