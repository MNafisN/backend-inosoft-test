<?php

namespace App\Services;

use App\Repositories\KendaraanRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class MotorService extends KendaraanService
{
    protected $KendaraanRepository;

    public function __construct(KendaraanRepository $KendaraanRepository)
    {
        $this->KendaraanRepository = $KendaraanRepository;
    }

    /**
     * Untuk validasi atribut motor pada form tambah/update data kendaraan.
     */
    public function validatorMotor(array $data): array
    {
        $formData = parent::validatorKendaraan($data);

        $validator = Validator::make($formData, [
            'mesin' => 'required|string',
            'tipe_suspensi' => 'required|string',
            'tipe_transmisi' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        return $data;
    }
}