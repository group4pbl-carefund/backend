<?php

namespace App\Http\Controllers\Api;

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
        return DistributionResource::collection($distributions);
    }

    /**
     * Menyimpan data distribusi baru.
     */
    public function store(StoreDistributionRequest $request): JsonResponse
    {
        $distribution = $this->distributionService->store($request->validated());
        
        return response()->json([
            'success' => true,
            'message' => 'Data distribusi berhasil disimpan',
            'data'    => new DistributionResource($distribution)
        ], 201);
    }
}