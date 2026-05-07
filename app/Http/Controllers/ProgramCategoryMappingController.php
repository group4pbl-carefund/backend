<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgramCategoryMapping\StoreProgramCategoryMappingRequest;
use App\Http\Requests\ProgramCategoryMapping\UpdateProgramCategoryMappingRequest;
use App\Http\Resources\ProgramCategoryMappingResource;
use App\Models\ProgramCategoryMapping;
use App\Services\ProgramCategoryMappingService;

class ProgramCategoryMappingController extends Controller
{
    protected $mappingService;

    public function __construct(ProgramCategoryMappingService $mappingService)
    {
        $this->mappingService = $mappingService;
    }

    /**
     * Menampilkan daftar pemetaan kategori program.
     *
     * Mengambil semua hubungan antara program dan kategorinya.
     */
    public function index()
    {
        return $this->successResponse(ProgramCategoryMappingResource::collection($this->mappingService->getAllMappings()));
    }

    /**
     * Membuat pemetaan kategori baru.
     *
     * Menghubungkan sebuah program dengan kategori tertentu.
     */
    public function store(StoreProgramCategoryMappingRequest $request)
    {
        $mapping = $this->mappingService->createMapping($request->validated());
        return $this->successResponse(new ProgramCategoryMappingResource($mapping));
    }

    /**
     * Menampilkan detail pemetaan.
     *
     * Mengambil informasi spesifik dari sebuah pemetaan kategori berdasarkan ID.
     */
    public function show(ProgramCategoryMapping $programCategoryMapping)
    {
        return $this->successResponse(new ProgramCategoryMappingResource($programCategoryMapping));
    }

    /**
     * Memperbarui data pemetaan.
     *
     * Mengubah hubungan pemetaan kategori yang sudah ada.
     */
    public function update(UpdateProgramCategoryMappingRequest $request, ProgramCategoryMapping $programCategoryMapping)
    {
        $updatedMapping = $this->mappingService->updateMapping($programCategoryMapping, $request->validated());
        return $this->successResponse(new ProgramCategoryMappingResource($updatedMapping));
    }

    /**
     * Menghapus pemetaan.
     *
     * Menghapus hubungan antara program dan kategori secara permanen.
     */
    public function destroy(ProgramCategoryMapping $programCategoryMapping)
    {
        $this->mappingService->deleteMapping($programCategoryMapping);
        return $this->deletedResponse();
    }
}
