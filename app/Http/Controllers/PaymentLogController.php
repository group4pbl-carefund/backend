<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentLog\StorePaymentLogRequest;
use App\Http\Resources\PaymentLogResource;
use App\Services\PaymentLogService;
use Illuminate\Http\JsonResponse;

class PaymentLogController extends Controller
{
    protected $service;

    public function __construct(PaymentLogService $service)
    {
        $this->service = $service;
    }

    /**
     * Menampilkan daftar log pembayaran.
     *
     * Mengambil semua riwayat log transaksi pembayaran dari database.
     */
    public function index()
    {
        return $this->successResponse(PaymentLogResource::collection($this->service->getAll()));
    }

    /**
     * Mencatat log pembayaran baru.
     *
     * Membuat record log baru untuk setiap aktivitas pembayaran.
     */
    public function store(StorePaymentLogRequest $request): JsonResponse
    {
        $log = $this->service->store($request->validated());
        return response()->json([
            'success' => true,
            'data'    => new PaymentLogResource($log)
        ], 201);
    }
}