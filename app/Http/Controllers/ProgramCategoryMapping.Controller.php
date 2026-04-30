<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProgramCategoryMappingRequest;
use App\Http\Requests\UpdateProgramCategoryMappingRequest;
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

    public function index()
    {
        return ProgramCategoryMappingResource::collection($this->mappingService->getAllMappings());
    }

    public function store(StoreProgramCategoryMappingRequest $request)
    {
        $mapping = $this->mappingService->createMapping($request->validated());
        return new ProgramCategoryMappingResource($mapping);
    }

    public function show(ProgramCategoryMapping $programCategoryMapping)
    {
        return new ProgramCategoryMappingResource($programCategoryMapping);
    }

    public function update(UpdateProgramCategoryMappingRequest $request, ProgramCategoryMapping $programCategoryMapping)
    {
        $updatedMapping = $this->mappingService->updateMapping($programCategoryMapping, $request->validated());
        return new ProgramCategoryMappingResource($updatedMapping);
    }

    public function destroy(ProgramCategoryMapping $programCategoryMapping)
    {
        $this->mappingService->deleteMapping($programCategoryMapping);
        return response()->noContent();
    }
}