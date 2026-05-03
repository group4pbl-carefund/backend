<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Distribution\StoreDistributionRequest;
use App\Http\Resources\DistributionResource;
use App\Services\DistributionService;
use Illuminate\Http\JsonResponse;

class DistributionController extends Controller
{
    protected $distributionService;

    /**
     * Inject DistributionService melalui constructor.
     */
    public function __construct(DistributionService $distributionService)
    {
        $this->distributionService = $distributionService;
    }

    /**
     * Menampilkan daftar distribusi.
     */
    public function index()
    {
        $distributions = $this->distributionService->getAll();
        return $this->successResponse(DistributionResource::collection($distributions));
    }

    /**
     * Menyimpan data distribusi baru.
     */
    public function store(StoreDistributionRequest $request): JsonResponse
    {
        $distribution = $this->distributionService->store($request->validated());
        
        return $this->successResponse(new DistributionResource($distribution), 'Data distribusi berhasil disimpan', 201);
    }
}