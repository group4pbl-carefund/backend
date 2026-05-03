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
     * Menampilkan daftar data.
     *
     * Endpoint ini mengembalikan semua record yang tersedia.
     */
    public function index()
    {
        return $this->successResponse(ProgramCategoryMappingResource::collection($this->mappingService->getAllMappings()));
    }

    /**
     * Menambahkan data baru.
     *
     * Endpoint ini digunakan untuk membuat record baru di database.
     */
    public function store(StoreProgramCategoryMappingRequest $request)
    {
        $mapping = $this->mappingService->createMapping($request->validated());
        return $this->successResponse(new ProgramCategoryMappingResource($mapping));
    }

    /**
     * Menampilkan detail data.
     *
     * Endpoint ini mengembalikan detail spesifik dari sebuah record berdasarkan ID.
     */
    public function show(ProgramCategoryMapping $programCategoryMapping)
    {
        return $this->successResponse(new ProgramCategoryMappingResource($programCategoryMapping));
    }

    /**
     * Memperbarui data.
     *
     * Endpoint ini digunakan untuk mengupdate record yang sudah ada di database.
     */
    public function update(UpdateProgramCategoryMappingRequest $request, ProgramCategoryMapping $programCategoryMapping)
    {
        $updatedMapping = $this->mappingService->updateMapping($programCategoryMapping, $request->validated());
        return $this->successResponse(new ProgramCategoryMappingResource($updatedMapping));
    }

    /**
     * Menghapus data.
     *
     * Endpoint ini digunakan untuk menghapus record dari database secara permanen.
     */
    public function destroy(ProgramCategoryMapping $programCategoryMapping)
    {
        $this->mappingService->deleteMapping($programCategoryMapping);
        return $this->deletedResponse();
    }
}
