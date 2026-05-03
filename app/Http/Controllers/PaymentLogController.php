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
     * Menampilkan daftar data.
     *
     * Endpoint ini mengembalikan semua record yang tersedia.
     */
    public function index()
    {
        return $this->successResponse(PaymentLogResource::collection($this->service->getAll()));
    }

    /**
     * Menambahkan data baru.
     *
     * Endpoint ini digunakan untuk membuat record baru di database.
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