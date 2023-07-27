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
    public function validator($request)
    {
        $validator = Validator::make($request, [
            'nama_kendaraan' => 'required|unique:App\Models\Kendaraan,nama_kendaraan',
            'tahun_keluaran' => 'required|numeric|min:1900|max:2500',
            'warna' => ['required', 'string'],
            'harga' => ['required', 'numeric'],
            'stok' => ['required', 'numeric'],
            'terjual' => ['required', 'numeric'],
            'tipe_kendaraan' => ['required', Rule::in(['motor', 'mobil'])],
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }
        
        return ($request);
    }

    /**
     * Tampilkan daftar semua kendaraan.
     */
    public function getAll(): ?Object
    {
        return $this->KendaraanRepository->getAll();
    }

    /**
     * Tampilkan detail data dari sebuah kendaraan berdasarkan id.
     */
    public function findById(string $id): Object
    {
        return $this->KendaraanRepository->getById($id);
    }

    /**
     * Simpan data kendaraan baru.
     */
    public function store($data): Object
    {
        return $this->KendaraanRepository->store($data);
    }

    /**
     * Simpan data kendaraan yang ingin diperbarui.
     */
    public function update($data, string $id): Object
    {
        return $this->KendaraanRepository->update($data, $id);
    }

    /**
     * Hapus data kendaraan berdasarkan id.
     */
    public function deleteById(string $id): string
    {
        return $this->KendaraanRepository->deleteById($id);
    }

    /**
     * Tampilkan daftar semua kendaraan berjenis mobil.
     */
    public function getAllMobil(): Object
    {
        return $this->KendaraanRepository->getAllMobil();
    }

    /**
     * Tampilkan jumlah stok dari daftar semua kendaraan berjenis mobil.
     */
    public function getAllStockMobil(): Object
    {
        return $this->KendaraanRepository->getAllStockMobil();
    }

    /**
     * Tampilkan jumlah terjual dari daftar semua kendaraan berjenis mobil.
     */
    public function getAllTerjualMobil(): Object
    {
        return $this->KendaraanRepository->getAllTerjualMobil();
    }

    /**
     * Tampilkan daftar semua kendaraan berjenis motor.
     */
    public function getAllMotor(): Object
    {
        return $this->KendaraanRepository->getAllMotor();
    }

    /**
     * Tampilkan jumlah stok dari daftar semua kendaraan berjenis motor.
     */
    public function getAllStockMotor(): Object
    {
        return $this->KendaraanRepository->getAllStockMotor();
    }

    /**
     * Tampilkan jumlah terjual dari daftar semua kendaraan berjenis motor.
     */
    public function getAllTerjualMotor(): Object
    {
        return $this->KendaraanRepository->getAllTerjualMotor();
    }
}