<?php

namespace Tests\Unit;

use App\Models\Penjualan;
use Tests\TestCase;

class PenjualanTest extends TestCase
{
    public function test_get_all_penjualan()
    {
        $response = $this->get('api/penjualan/list');

        $response->assertStatus(200);
    }

    public function test_find_penjualan_by_nama_kendaraan()
    {
        $penjualan = Penjualan::factory()->create();
        $nama = rawurldecode($penjualan->nama_kendaraan);
        $response = $this->get("api/penjualan/list/" . $nama);

        $response->assertStatus(200);
    }

    /**
     * Fungsi di bawah ini memerlukan tester untuk melakukan login terlebih dahulu karena fitur ini memerlukan nama logged in user.
     */
    public function test_create_transaksi_penjualan()
    {
        $formData = [
            "nama_kendaraan" => "Jordy",
            "jumlah_beli" => 2,
        ];

        $response = $this->post('api/penjualan/buy', $formData);

        $response->assertStatus(201);
    }
}
