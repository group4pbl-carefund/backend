<?php

namespace App\Http\Controllers;

use App\Http\Requests\DistributionUpdate\StoreDistributionUpdateRequest;
use App\Http\Resources\DistributionUpdateResource;
use App\Services\DistributionUpdateService;
use Illuminate\Http\JsonResponse;

class DistributionUpdateController extends Controller
{
    protected $service;

    public function __construct(DistributionUpdateService $service)
    {
        $this->service = $service;
    }

    /**
     * Menampilkan semua pembaruan distribusi.
     *
     * Mengambil riwayat update progress penyaluran dana.
     */
    public function index()
    {
        return $this->successResponse(DistributionUpdateResource::collection($this->service->getAll()));
    }

    /**
     * Membuat pembaruan distribusi baru.
     *
     * Menambahkan laporan progress baru untuk penyaluran dana tertentu.
     */
    public function store(StoreDistributionUpdateRequest $request): JsonResponse
    {
        $update = $this->service->store($request->validated());

        return $this->successResponse(new DistributionUpdateResource($update));
    }
}
