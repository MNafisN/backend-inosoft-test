<?php

namespace App\Services;

use App\Repositories\KendaraanRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class MobilService extends KendaraanService
{
    protected $KendaraanRepository;

    public function __construct(KendaraanRepository $KendaraanRepository)
    {
        $this->KendaraanRepository = $KendaraanRepository;
    }

    /**
     * Untuk validasi atribut mobil pada form tambah/update data kendaraan.
     */
    public function validatorMobil(array $data): array
    {
        $formData = parent::validatorKendaraan($data);

        $validator = Validator::make($formData, [
            'mesin' => 'required|string',
            'kapasitas_penumpang' => 'required|numeric',
            'tipe' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        return $data;
    }
}