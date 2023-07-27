<?php

namespace App\Http\Controllers;

use App\Services\MobilService;
use App\Services\MotorService;
use Exception;
use Illuminate\Http\Request;
use App\Services\KendaraanService;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;

class KendaraanController extends Controller
{
    private $motorService;
    private $kendaraanService;
    private $mobilService;

    public function __construct(MotorService $motorService, KendaraanService $kendaraanService, MobilService $mobilService)
    {
        $this->middleware('auth:api');
        $this->motorService = $motorService;
        $this->kendaraanService = $kendaraanService;
        $this->mobilService = $mobilService;
    }

    /**
     * Tampilkan daftar semua kendaraan.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $result = [
                'status' => 200,
                'data' => $this->kendaraanService->getAll()
            ];
        } catch (Exception $err) {
            $result = [
                'status' => 404,
                'error' => $err->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(): JsonResponse
    {
        return response()->json();
    }

    /**
     * Simpan data kendaraan baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->all();
        try {
            if ($data['tipe_kendaraan'] == 'mobil') {
                $dataTervalidasi = $this->mobilService->validatorMobil($data);
            } else if ($data['tipe_kendaraan'] == 'motor') {
                $dataTervalidasi = $this->motorService->validatorMotor($data);
            } else {
                throw new InvalidArgumentException('Tipe kendaraan yang tersedia hanya mobil dan motor');
            }
            $result = [
                'status' => 201,
                'data' => $this->kendaraanService->store($dataTervalidasi)
            ];
        } catch (Exception $err) {
            $result = [
                'status' => 422,
                'error' => $err->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

    /**
     * Tampilkan detail data dari sebuah kendaraan berdasarkan id.
     *
     * @param  string  $kendaraanId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $kendaraanId): JsonResponse
    {
        try {
            $result = [
                'status' => 200,
                'data' => $this->kendaraanService->findById($kendaraanId)
            ];
        } catch (Exception $err) {
            $result = [
                'status' => 404,
                'error' => $err->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id): JsonResponse
    {
        return response()->json();
    }

    /**
     * Simpan data kendaraan yang ingin diperbarui.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $kendaraanId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $kendaraanId): JsonResponse
    {
        $data = $request->all();
        try {
            if ($data['tipe_kendaraan'] == 'mobil') {
                $dataTervalidasi = $this->mobilService->validatorMobil($data);
            } else if ($data['tipe_kendaraan'] == 'motor') {
                $dataTervalidasi = $this->motorService->validatorMotor($data);
            } else {
                throw new InvalidArgumentException('Tipe kendaraan yang tersedia hanya mobil dan motor');
            }
            $result = [
                'status' => 200,
                'data' => $this->kendaraanService->update($dataTervalidasi, $kendaraanId)
            ];
        } catch (Exception $err) {
            $result = [
                'status' => 422,
                'error' => $err->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

    /**
     * Hapus data kendaraan berdasarkan id.
     *
     * @param  string  $kendaraanId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $kendaraanId): JsonResponse
    {
        try {
            $result = [
                'status' => 200,
                'data' => $this->kendaraanService->deleteById($kendaraanId)
            ];
        } catch (Exception $err) {
            $result = [
                'status' => 404,
                'error' => $err->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

    /**
     * Tampilkan daftar semua kendaraan berjenis mobil.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllMobil(): JsonResponse
    {
        try {
            $result = [
                'status' => 200,
                'data' => $this->kendaraanService->getAllMobil()
            ];
        } catch (Exception $err) {
            $result = [
                'status' => 404,
                'error' => $err->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

    /**
     * Tampilkan jumlah stok dari daftar semua kendaraan berjenis mobil.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllStockMobil(): JsonResponse
    {
        try {
            $result = [
                'status' => 200,
                'data' => $this->kendaraanService->getAllStockMobil()
            ];
        } catch (Exception $err) {
            $result = [
                'status' => 404,
                'error' => $err->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

    /**
     * Tampilkan jumlah terjual dari daftar semua kendaraan berjenis mobil.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllTerjualMobil(): JsonResponse
    {
        try {
            $result = [
                'status' => 200,
                'data' => $this->kendaraanService->getAllTerjualMobil()
            ];
        } catch (Exception $err) {
            $result = [
                'status' => 404,
                'error' => $err->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

    /**
     * Tampilkan daftar semua kendaraan berjenis motor.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllMotor(): JsonResponse
    {
        try {
            $result = [
                'status' => 200,
                'data' => $this->kendaraanService->getAllMotor()
            ];
        } catch (Exception $err) {
            $result = [
                'status' => 404,
                'error' => $err->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

    /**
     * Tampilkan jumlah stok dari daftar semua kendaraan berjenis motor.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllStockMotor(): JsonResponse
    {
        try {
            $result = [
                'status' => 200,
                'data' => $this->kendaraanService->getAllStockMotor()
            ];
        } catch (Exception $err) {
            $result = [
                'status' => 404,
                'error' => $err->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

    /**
     * Tampilkan jumlah terjual dari daftar semua kendaraan berjenis motor.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllTerjualMotor(): JsonResponse
    {
        try {
            $result = [
                'status' => 200,
                'data' => $this->kendaraanService->getAllTerjualMotor()
            ];
        } catch (Exception $err) {
            $result = [
                'status' => 404,
                'error' => $err->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }
}
