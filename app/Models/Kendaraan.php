<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

use App\Models\Penjualan;

class Kendaraan extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'kendaraans';

    protected $fillable = [
        'nama_kendaraan', 'tahun_keluaran', 'warna', 'harga', 'stok', 'terjual', 'tipe_kendaraan', ' mesin', 'tipe_suspensi', 'tipe_transmisi', 'kapasitas_penumpang', 'tipe'
    ];

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'nama_kendaraan', 'nama_kendaraan');
    }
}