<?php

namespace App\Http\Controllers;

use App\Services\MobilService;
use App\Services\MotorService;
use Exception;
use Illuminate\Http\Request;
use App\Services\KendaraanService;
use Illuminate\Http\JsonResponse;

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
            return response()->json($this->kendaraanService->getAll());
        } catch (Exception $err) {
            return response()->json($err->getMessage());
        }
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
        try {
            if ($request->tipe_kendaraan == 'motor') {
                $datatervalidasi = $this->motorService->validator($request);
                return response()->json($this->kendaraanService->store($datatervalidasi));
            } else {
                $datatervalidasi = $this->mobilService->validator($request);
                return response()->json($this->kendaraanService->store($datatervalidasi));
            }
        } catch (Exception $err) {
            return response()->json($err->getMessage());
        }
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
            return response()->json($this->kendaraanService->findById($kendaraanId));
        } catch (Exception $err) {
            return response()->json($err->getMessage());
        }
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
     * @param  int  $kendaraanId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $kendaraanId): JsonResponse
    {
        try {
            $datatervalidasi = $this->motorService->validator($request);
            return response()->json($this->kendaraanService->update($datatervalidasi, $kendaraanId));
        } catch (Exception $err) {
            return response()->json($err->getMessage());
        }
    }

    /**
     * Hapus data kendaraan berdasarkan id.
     *
     * @param  int  $kendaraanId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $kendaraanId): JsonResponse
    {
        try {
            return response()->json($this->kendaraanService->deleteById($kendaraanId));
        } catch (Exception $err) {
            return response()->json($err->getMessage());
        }
    }

    /**
     * Tampilkan daftar semua kendaraan berjenis mobil.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllMobil(): JsonResponse
    {
        try {
            return response()->json($this->kendaraanService->getAllMobil());
        } catch (Exception $err) {
            return response()->json($err->getMessage());
        }
    }

    /**
     * Tampilkan jumlah stok dari daftar semua kendaraan berjenis mobil.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllStockMobil(): JsonResponse
    {
        try {
            return response()->json($this->kendaraanService->getAllStockMobil());
        } catch (Exception $err) {
            return response()->json($err->getMessage());
        }
    }

    /**
     * Tampilkan jumlah terjual dari daftar semua kendaraan berjenis mobil.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllTerjualMobil(): JsonResponse
    {
        try {
            return response()->json($this->kendaraanService->getAllTerjualMobil());
        } catch (Exception $err) {
            return response()->json($err->getMessage());
        }
    }

    /**
     * Tampilkan daftar semua kendaraan berjenis motor.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllMotor(): JsonResponse
    {
        try {
            return response()->json($this->kendaraanService->getAllMotor());
        } catch (Exception $err) {
            return response()->json($err->getMessage());
        }
    }

    /**
     * Tampilkan jumlah stok dari daftar semua kendaraan berjenis motor.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllStockMotor(): JsonResponse
    {
        try {
            return response()->json($this->kendaraanService->getAllStockMotor());
        } catch (Exception $err) {
            return response()->json($err->getMessage());
        }
    }

    /**
     * Tampilkan jumlah terjual dari daftar semua kendaraan berjenis motor.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllTerjualMotor(): JsonResponse
    {
        try {
            return response()->json($this->kendaraanService->getAllTerjualMotor());
        } catch (Exception $err) {
            return response()->json($err->getMessage());
        }
    }
}
