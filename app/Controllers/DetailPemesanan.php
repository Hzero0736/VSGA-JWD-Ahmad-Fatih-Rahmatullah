<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PemesananModel;
use CodeIgniter\HTTP\ResponseInterface;

class DetailPemesanan extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new PemesananModel();
    }

    public function index()
    {
        $data = [
            'pemesanan' => $this->model->findAll()
        ];
        echo view('layout/header');
        echo view('layout/navbar');
        echo view('public/detailPemesanan', $data);
        echo view('layout/footer');
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return redirect()->to(base_url('pesanan'));
    }

    public function edit($id)
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'nohp' => $this->request->getPost('nohp'),
            'tgl' => $this->request->getPost('tgl'),
            'durasi' => $this->request->getPost('durasi'),
            'jmlh_peserta' => $this->request->getPost('jmlh_peserta'),
            'lay_penginapan' => $this->request->getPost('lay_penginapan') ? 1 : 0,
            'lay_transportasi' => $this->request->getPost('lay_transportasi') ? 1 : 0,
            'lay_makan' => $this->request->getPost('lay_makan') ? 1 : 0,
        ];

        // Hitung harga paket
        $harga = 0;
        if ($data['lay_penginapan']) $harga += 1000000;
        if ($data['lay_transportasi']) $harga += 1200000;
        if ($data['lay_makan']) $harga += 500000;

        $data['harga'] = $harga;
        $data['jmlh_harga'] = $harga * $data['jmlh_peserta'] * $data['durasi'];

        $this->model->update($id, $data);
        return redirect()->to(base_url('pesanan'));
    }
}
