<?php

namespace App\Services;

use App\Repositories\PenjualanRepository;
use App\Repositories\KendaraanRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class PenjualanService
{
    private $penjualanRepository;
    private $kendaraanRepository;

    public function __construct(PenjualanRepository $penjualanRepository, KendaraanRepository $kendaraanRepository)
    {
        $this->penjualanRepository = $penjualanRepository;
        $this->kendaraanRepository = $kendaraanRepository;
    }

    /**
     * Tampilkan daftar semua histori penjualan kendaraan.
     */
    public function getAll(): Object
    {
        $penjualans = $this->penjualanRepository->getAll();
        if ($penjualans->isEmpty()) {
            throw new InvalidArgumentException('Data Penjualan Kosong');
        }
        return $penjualans;
    }

    /**
     * Tampilkan daftar semua histori penjualan pada suatu kendaraan.
     */
    public function getByNamaKendaraan(string $nama): Object
    {
        $decoder = urldecode($nama);
        $penjualans = $this->penjualanRepository->getByKendaraan($decoder);
        if ($penjualans->isEmpty()) {
            throw new InvalidArgumentException("Data Penjualan untuk Kendaraan" . $nama . "Kosong");
        }
        return $penjualans;
    }

    /**
     * Untuk menyimpan data pembelian baru pada suatu kendaraan.
     */
    public function beliKendaraan(array $formData): Object
    {
        $validator = Validator::make($formData, [
            'nama_kendaraan' => 'required|string',
            'jumlah_beli' => 'required|numeric|min:1'
        ]);
        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $kendaraan = $this->kendaraanRepository->getByName($formData['nama_kendaraan']);
        if (!$kendaraan) {
            throw new InvalidArgumentException('Kendaraan tidak ditemukan');
        }
        if ($formData['jumlah_beli'] > $kendaraan->stok) {
            throw new InvalidArgumentException('Stok kendaraan tidak cukup');
        } else {
            $formData['nama_pembeli'] = auth()->user()['name'];
            $this->kendaraanRepository->updateStok($formData['nama_kendaraan'], (int)$formData['jumlah_beli']);
        }

        $penjualan = $this->penjualanRepository->store($formData);
        return $penjualan;
    }
}