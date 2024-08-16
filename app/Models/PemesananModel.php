<?php

namespace App\Models;

use CodeIgniter\Model;

class PemesananModel extends Model
{
    protected $table            = 'pemesanan';
    protected $primaryKey       = 'id_pemesanan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama',
        'nohp',
        'tgl',
        'durasi',
        'lay_penginapan',
        'lay_transportasi',
        'lay_makan',
        'jmlh_peserta',
        'harga',
        'jmlh_harga'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nama' => 'required',
        'nohp' => 'required',
        'tgl' => 'required',
        'durasi' => 'required|numeric|greater_than[0]',
        'jmlh_peserta' => 'required|numeric|greater_than[0]',
        'harga' => 'required|numeric|greater_than[0]',
        'jmlh_harga' => 'required|numeric|greater_than[0]',
    ];
    protected $validationMessages   = [
        'nama' => ['required' => 'Nama harus diisi'],
        'nohp' => ['required' => 'Nomor HP harus diisi'],
        'tgl' => ['required' => 'Tanggal harus diisi'],
        'durasi' => [
            'required' => 'Durasi harus diisi',
            'numeric' => 'Durasi harus berupa angka',
            'greater_than' => 'Durasi harus lebih dari 0'
        ],
        'jmlh_peserta' => [
            'required' => 'Jumlah peserta harus diisi',
            'numeric' => 'Jumlah peserta harus berupa angka',
            'greater_than' => 'Jumlah peserta harus lebih dari 0'
        ],
        'harga' => [
            'required' => 'Harga paket harus diisi',
            'numeric' => 'Harga paket harus berupa angka',
            'greater_than' => 'Harga paket harus lebih dari 0'
        ],
        'jmlh_harga' => [
            'required' => 'Jumlah harga harus diisi',
            'numeric' => 'Jumlah harga harus berupa angka',
            'greater_than' => 'Jumlah harga harus lebih dari 0'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function getPemesanan()
    {
        return $this->findAll();
    }

    public function hitungHargaPaket($layanan)
    {
        $harga = 0;
        if ($layanan['penginapan']) $harga += 1000000;
        if ($layanan['transportasi']) $harga += 1200000;
        if ($layanan['makanan']) $harga += 500000;
        return $harga;
    }

    public function hitungTotalHarga($durasi, $jumlahPeserta, $hargaPaket)
    {
        return $durasi * $jumlahPeserta * $hargaPaket;
    }
}
