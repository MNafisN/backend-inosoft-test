<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

use App\Models\Kendaraan;

class Penjualan extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'penjualans';

    protected $fillable = ['nama_kendaraan', 'nama_pembeli', 'jumlah_beli'];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'nama_kendaraan', 'nama_kendaraan');
    }
}