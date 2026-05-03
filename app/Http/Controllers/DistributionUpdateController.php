<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
     * Menampilkan daftar data.
     *
     * Endpoint ini mengembalikan semua record yang tersedia.
     */
    public function index()
    {
        return $this->successResponse(DistributionUpdateResource::collection($this->service->getAll()));
    }

    /**
     * Menambahkan data baru.
     *
     * Endpoint ini digunakan untuk membuat record baru di database.
     */
    public function store(StoreDistributionUpdateRequest $request): JsonResponse
    {
        $update = $this->service->store($request->validated());
        return response()->json([
            'success' => true,
            'data'    => new DistributionUpdateResource($update)
        ], 201);
    }
}