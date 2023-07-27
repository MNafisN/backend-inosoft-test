<?php

namespace Tests\Unit;

use App\Models\Kendaraan;
use Tests\TestCase;

class KendaraanTest extends TestCase
{
    public function test_get_all_kendaraan()
    {
        $response = $this->get('api/kendaraan');

        $response->assertStatus(200);
    }

    public function test_find_by_id_kendaraan()
    {
        $kendaraan = Kendaraan::factory()->create();

        $response = $this->get("api/kendaraan/" . $kendaraan->id);

        $response->assertStatus(200);
    }

    public function test_create_kendaraan()
    {
        $formData = [
            "nama_kendaraan" => "Avanza",
            "tahun_keluaran" => "2005",
            "warna" => "kuning",
            "harga" => 978875602,
            "stok" => 7846,
            "terjual" => 276,
            "tipe_kendaraan" => "mobil",
            "mesin" => "doyler",
            "kapasitas_penumpang" => 6,
            "tipe" => "lorem ipsum"
        ];

        $response = $this->post('api/kendaraan', $formData);

        $response->assertStatus(201);
    }

    public function test_get_all_mobil()
    {
        $response = $this->get('api/kendaraan/mobil/list');

        $response->assertStatus(200);
    }

    public function test_get_mobil_stock()
    {
        $response = $this->get('api/kendaraan/mobil/stock');

        $response->assertStatus(200);
    }

    public function test_get_mobil_terjual()
    {
        $response = $this->get('api/kendaraan/mobil/terjual');

        $response->assertStatus(200);
    }

    public function test_get_all_motor()
    {
        $response = $this->get('api/kendaraan/motor/list');

        $response->assertStatus(200);
    }

    public function test_get_motor_stock()
    {
        $response = $this->get('api/kendaraan/motor/stock');

        $response->assertStatus(200);
    }

    public function test_get_motor_terjual()
    {
        $response = $this->get('api/kendaraan/motor/terjual');

        $response->assertStatus(200);
    }
}
