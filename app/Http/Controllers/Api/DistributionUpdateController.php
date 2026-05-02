<?php

namespace App\Http\Controllers\Api;

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

    public function index()
    {
        return DistributionUpdateResource::collection($this->service->getAll());
    }

    public function store(StoreDistributionUpdateRequest $request): JsonResponse
    {
        $update = $this->service->store($request->validated());
        return response()->json([
            'success' => true,
            'data'    => new DistributionUpdateResource($update)
        ], 201);
    }
}