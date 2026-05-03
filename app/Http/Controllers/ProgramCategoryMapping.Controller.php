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
        return $this->successResponse(ProgramCategoryMappingResource::collection($this->mappingService->getAllMappings()));
    }

    public function store(StoreProgramCategoryMappingRequest $request)
    {
        $mapping = $this->mappingService->createMapping($request->validated());
        return $this->successResponse(new ProgramCategoryMappingResource($mapping));
    }

    public function show(ProgramCategoryMapping $programCategoryMapping)
    {
        return $this->successResponse(new ProgramCategoryMappingResource($programCategoryMapping));
    }

    public function update(UpdateProgramCategoryMappingRequest $request, ProgramCategoryMapping $programCategoryMapping)
    {
        $updatedMapping = $this->mappingService->updateMapping($programCategoryMapping, $request->validated());
        return $this->successResponse(new ProgramCategoryMappingResource($updatedMapping));
    }

    public function destroy(ProgramCategoryMapping $programCategoryMapping)
    {
        $this->mappingService->deleteMapping($programCategoryMapping);
        return $this->deletedResponse();
    }
}