<?php

namespace App\Repositories;

use App\Models\Kendaraan;

class KendaraanRepository
{
    private $kendaraan;

    public function __construct(Kendaraan $kendaraan)
    {
        $this->kendaraan = $kendaraan;
    }

    /**
     * Tampilkan daftar semua kendaraan.
     */
    public function getAll(): Object
    {
        $kendaraans = $this->kendaraan->get();
        return $kendaraans;
    }

    /**
     * Tampilkan detail data dari sebuah kendaraan berdasarkan id.
     */
    public function getById(string $id): ?Object
    {
        $kendaraan = $this->kendaraan->find($id);
        return $kendaraan;
    }

    /**
     * Tampilkan detail data dari sebuah kendaraan berdasarkan nama kendaraan.
     */
    public function getByName(string $nama): ?Object
    {
        $kendaraan = $this->kendaraan->where('nama_kendaraan', $nama)->first();
        return $kendaraan;
    }

    /**
     * Simpan data kendaraan baru.
     */
    public function store($data): Object
    {
        $kendaraan = new Kendaraan;

        $kendaraan->nama_kendaraan = $data['nama_kendaraan'];
        $kendaraan->tahun_keluaran = $data['tahun_keluaran'];
        $kendaraan->warna = $data['warna'];
        $kendaraan->harga = $data['harga'];
        $kendaraan->stok = $data['stok'];
        $kendaraan->terjual = $data['terjual'];
        $kendaraan->tipe_kendaraan = $data['tipe_kendaraan'];

        if ($data['tipe_kendaraan'] == "motor") {
            $kendaraan->mesin = $data['mesin'];
            $kendaraan->tipe_suspensi = $data['tipe_suspensi'];
            $kendaraan->tipe_transmisi = $data['tipe_transmisi'];
        } else {
            $kendaraan->mesin = $data['mesin'];
            $kendaraan->kapasistas_penumpang = $data['kapasistas_penumpang'];
            $kendaraan->tipe = $data['tipe'];
        }

        $kendaraan->save();

        return $kendaraan->fresh();
    }

    /**
     * Simpan data kendaraan yang ingin diperbarui.
     */
    public function update($data, string $id): Object
    {
        $kendaraan = Kendaraan::find($id);

        $kendaraan->nama_kendaraan = $data['nama_kendaraan'];
        $kendaraan->tahun_keluaran = $data['tahun_keluaran'];
        $kendaraan->warna = $data['warna'];
        $kendaraan->harga = $data['harga'];
        $kendaraan->stok = $data['stok'];
        $kendaraan->terjual = $data['terjual'];
        $kendaraan->tipe_kendaraan = $data['tipe_kendaraan'];

        if ($data['tipe_kendaraan'] == "motor") {
            $kendaraan->mesin = $data['mesin'];
            $kendaraan->tipe_suspensi = $data['tipe_suspensi'];
            $kendaraan->tipe_transmisi = $data['tipe_transmisi'];
        } else {
            $kendaraan->mesin = $data['mesin'];
            $kendaraan->kapasistas_penumpang = $data['kapasistas_penumpang'];
            $kendaraan->tipe = $data['tipe'];
        }

        $kendaraan->update();

        return $kendaraan->fresh();
    }

    /**
     * Hapus data kendaraan berdasarkan id.
     */
    public function deleteById(string $id): string
    {
        return $this->kendaraan->destroy($id) ? 'Data Deleted' : 'Data Not Found';
    }

    /**
     * Tampilkan daftar semua kendaraan berjenis mobil.
     */
    public function getAllMobil(): Object
    {
        $kendaraans = $this->kendaraan->where('tipe_kendaraan', 'mobil')->get();
        return $kendaraans;
    }

    /**
     * Tampilkan jumlah stok dari daftar semua kendaraan berjenis mobil.
     */
    public function getAllStockMobil(): Object
    {
        $kendaraans = $this->kendaraan->select('nama_kendaraan', 'tahun_keluaran', 'tipe_kendaraan', 'stok')
                                      ->where('tipe_kendaraan', 'mobil')->get();
        return $kendaraans;
    }

    /**
     * Tampilkan jumlah terjual dari daftar semua kendaraan berjenis mobil.
     */
    public function getAllTerjualMobil(): Object
    {
        $kendaraans = $this->kendaraan->select('nama_kendaraan', 'tahun_keluaran', 'tipe_kendaraan', 'terjual')
                                      ->where('tipe_kendaraan', 'mobil')->get();
        return $kendaraans;        
    }

    /**
     * Tampilkan daftar semua kendaraan berjenis motor.
     */
    public function getAllMotor(): Object
    {
        $kendaraans = $this->kendaraan->where('tipe_kendaraan', 'motor')->get();
        return $kendaraans;
    }

    /**
     * Tampilkan jumlah stok dari daftar semua kendaraan berjenis motor.
     */
    public function getAllStockMotor(): Object
    {
        $kendaraans = $this->kendaraan->select('nama_kendaraan', 'tahun_keluaran', 'tipe_kendaraan', 'stok')
                                      ->where('tipe_kendaraan', 'motor')->get();
        return $kendaraans;
    }

    /**
     * Tampilkan jumlah terjual dari daftar semua kendaraan berjenis motor.
     */
    public function getAllTerjualMotor(): Object
    {
        $kendaraans = $this->kendaraan->select('nama_kendaraan', 'tahun_keluaran', 'tipe_kendaraan', 'terjual')
                                      ->where('tipe_kendaraan', 'motor')->get();
        return $kendaraans;
    }
}