<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PemesananModel;
use CodeIgniter\HTTP\ResponseInterface;


class Pemesanan extends BaseController
{
    public function index()
    {
        echo view('layout/header');
        echo view('layout/navbar');
        echo view('public/packages');
        echo view('layout/footer');
    }

    public function tambah()
    {
        $model = new PemesananModel();

        $layanan = [
            'penginapan' => $this->request->getPost('penginapan') ? true : false,
            'transportasi' => $this->request->getPost('transportasi') ? true : false,
            'makanan' => $this->request->getPost('makanan') ? true : false,
        ];

        $durasi = $this->request->getPost('durasi');
        $jumlahPeserta = $this->request->getPost('jumlahPeserta');
        $hargaPaket = $model->hitungHargaPaket($layanan);
        $jumlahHarga = $model->hitungTotalHarga($durasi, $jumlahPeserta, $hargaPaket);

        $data = [
            'nama' => $this->request->getPost('nama'),
            'nohp' => $this->request->getPost('nomorTelp'),
            'tgl' => $this->request->getPost('tanggalPesan'),
            'durasi' => $durasi,
            'lay_penginapan' => $layanan['penginapan'] ? 1 : 0,
            'lay_transportasi' => $layanan['transportasi'] ? 1 : 0,
            'lay_makan' => $layanan['makanan'] ? 1 : 0,
            'jmlh_peserta' => $jumlahPeserta,
            'harga' => $hargaPaket,
            'jmlh_harga' => $jumlahHarga
        ];

        if ($model->insert($data) === false) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to(base_url('packages'))->with('success', 'Pemesanan berhasil ditambahkan');
    }
}
