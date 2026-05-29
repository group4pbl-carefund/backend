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
     * Menampilkan daftar semua distribusi dana.
     *
     * Mengambil riwayat penyaluran dana donasi ke penerima manfaat.
     */
    public function index()
    {
        $distributions = $this->distributionService->getAll();
        return $this->successResponse(DistributionResource::collection($distributions));
    }

    /**
     * Mencatat distribusi dana baru.
     *
     * Membuat record penyaluran dana untuk program tertentu.
     */
    public function store(StoreDistributionRequest $request): JsonResponse
    {
        $validated = $request->validated();
        
        if ($request->hasFile('evidence_image')) {
            $path = $request->file('evidence_image')->store('distributions', 'public');
            $validated['evidence_url'] = '/storage/' . $path;
            unset($validated['evidence_image']);
        }

        $distribution = $this->distributionService->store($validated);
        
        return $this->successResponse(new DistributionResource($distribution), 'Data distribusi berhasil disimpan', 201);
    }
}