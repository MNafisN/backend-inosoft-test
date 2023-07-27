<?php

namespace App\Services;

use App\Repositories\KendaraanRepository;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class KendaraanService
{
    protected $KendaraanRepository;

    public function __construct(KendaraanRepository $KendaraanRepository)
    {
        $this->KendaraanRepository = $KendaraanRepository;
    }

    /**
     * Untuk validasi atribut utama pada form tambah/update data kendaraan.
     */
    public function validatorKendaraan(array $data): array
    {
        $validator = Validator::make($data, [
            'nama_kendaraan' => 'required|unique:App\Models\Kendaraan,nama_kendaraan',
            'tahun_keluaran' => 'required|numeric|min:1900|max:2500',
            'warna' => 'required|string',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'terjual' => 'required|numeric',
            'tipe_kendaraan' => 'required|in:motor,mobil',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        return $data;
    }

    /**
     * Tampilkan daftar semua kendaraan.
     */
    public function getAll(): ?Object
    {
        $kendaraan = $this->KendaraanRepository->getAll();
        if ($kendaraan->isEmpty()) {
            throw new InvalidArgumentException('Data kendaraan pada database kosong');
        }
        return $kendaraan;
    }

    /**
     * Tampilkan detail data dari sebuah kendaraan berdasarkan id.
     */
    public function findById(string $id): Object
    {
        $kendaraan = $this->KendaraanRepository->getById($id);
        if (!$kendaraan) {
            throw new InvalidArgumentException('Data kendaraan tidak ditemukan');
        }
        return $kendaraan;
    }

    /**
     * Simpan data kendaraan baru.
     */
    public function store(array $data): Object
    {
        return $this->KendaraanRepository->store($data);
    }

    /**
     * Simpan data kendaraan yang ingin diperbarui.
     */
    public function update(array $data, string $id): Object
    {
        $kendaraan = $this->KendaraanRepository->getById($id);
        if (!$kendaraan) {
            throw new InvalidArgumentException('Data kendaraan tidak ditemukan');
        }
        return $this->KendaraanRepository->update($data, $id);
    }

    /**
     * Hapus data kendaraan berdasarkan id.
     */
    public function deleteById(string $id): string
    {
        $kendaraan = $this->KendaraanRepository->getById($id);
        if (!$kendaraan) {
            throw new InvalidArgumentException('Data kendaraan tidak ditemukan');
        }
        return $this->KendaraanRepository->deleteById($id);
    }

    /**
     * Tampilkan daftar semua kendaraan berjenis mobil.
     */
    public function getAllMobil(): Object
    {
        $kendaraan = $this->KendaraanRepository->getAllMobil();
        if ($kendaraan->isEmpty()) {
            throw new InvalidArgumentException('Data kendaraan jenis mobil pada database kosong');
        }
        return $kendaraan;
    }

    /**
     * Tampilkan jumlah stok dari daftar semua kendaraan berjenis mobil.
     */
    public function getAllStockMobil(): Object
    {
        $kendaraan = $this->KendaraanRepository->getAllStockMobil();
        if ($kendaraan->isEmpty()) {
            throw new InvalidArgumentException('Data kendaraan jenis mobil pada database kosong');
        }
        return $kendaraan;
    }

    /**
     * Tampilkan jumlah terjual dari daftar semua kendaraan berjenis mobil.
     */
    public function getAllTerjualMobil(): Object
    {
        $kendaraan = $this->KendaraanRepository->getAllTerjualMobil();
        if ($kendaraan->isEmpty()) {
            throw new InvalidArgumentException('Data kendaraan jenis mobil pada database kosong');
        }
        return $kendaraan;
    }

    /**
     * Tampilkan daftar semua kendaraan berjenis motor.
     */
    public function getAllMotor(): Object
    {
        $kendaraan = $this->KendaraanRepository->getAllMotor();
        if ($kendaraan->isEmpty()) {
            throw new InvalidArgumentException('Data kendaraan jenis motor pada database kosong');
        }
        return $kendaraan;
    }

    /**
     * Tampilkan jumlah stok dari daftar semua kendaraan berjenis motor.
     */
    public function getAllStockMotor(): Object
    {
        $kendaraan = $this->KendaraanRepository->getAllStockMotor();
        if ($kendaraan->isEmpty()) {
            throw new InvalidArgumentException('Data kendaraan jenis motor pada database kosong');
        }
        return $kendaraan;
    }

    /**
     * Tampilkan jumlah terjual dari daftar semua kendaraan berjenis motor.
     */
    public function getAllTerjualMotor(): Object
    {
        $kendaraan = $this->KendaraanRepository->getAllTerjualMotor();
        if ($kendaraan->isEmpty()) {
            throw new InvalidArgumentException('Data kendaraan jenis motor pada database kosong');
        }
        return $kendaraan;
    }
}