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

    public function index()
    {
        return $this->successResponse(PaymentLogResource::collection($this->service->getAll()));
    }

    public function store(StorePaymentLogRequest $request): JsonResponse
    {
        $log = $this->service->store($request->validated());
        return response()->json([
            'success' => true,
            'data'    => new PaymentLogResource($log)
        ], 201);
    }
}