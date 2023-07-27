<?php

namespace App\Repositories;

use App\Models\Penjualan;

class PenjualanRepository
{
    private $penjualan;

    public function __construct(Penjualan $penjualan)
    {
        $this->penjualan = $penjualan;
    }

    /**
     * Tampilkan daftar semua histori penjualan kendaraan.
     */
    public function getAll(): Object
    {
        $penjualans = $this->penjualan->get();
        return $penjualans;
    }

    /**
     * Cari data histori penjualan pada suatu kendaraan berdasarkan nama kendaraan.
     */
    public function getByKendaraan(string $nama): ?Object
    {
        $penjualans = $this->penjualan->where('nama_kendaraan', $nama)->get();
        return $penjualans;
    }

    public function store(array $data): Object
    {
        $penjualan = new $this->penjualan;

        $penjualan->nama_kendaraan = $data['nama_kendaraan'];
        $penjualan->nama_pembeli = $data['nama_pembeli'];
        $penjualan->jumlah_beli = $data['jumlah_beli'];

        $penjualan->save();
        return $penjualan->fresh();
    }
}