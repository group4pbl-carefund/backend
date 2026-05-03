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
<<<<<<< HEAD
        return $this->successResponse(ProgramCategoryMappingResource::collection($this->mappingService->getAllMappings()));
=======
        return ProgramCategoryMappingResource::collection($this->mappingService->getAllMappings());
>>>>>>> dev-nada
    }

    public function store(StoreProgramCategoryMappingRequest $request)
    {
        $mapping = $this->mappingService->createMapping($request->validated());
<<<<<<< HEAD
        return $this->successResponse(new ProgramCategoryMappingResource($mapping));
=======
        return new ProgramCategoryMappingResource($mapping);
>>>>>>> dev-nada
    }

    public function show(ProgramCategoryMapping $programCategoryMapping)
    {
<<<<<<< HEAD
        return $this->successResponse(new ProgramCategoryMappingResource($programCategoryMapping));
=======
        return new ProgramCategoryMappingResource($programCategoryMapping);
>>>>>>> dev-nada
    }

    public function update(UpdateProgramCategoryMappingRequest $request, ProgramCategoryMapping $programCategoryMapping)
    {
        $updatedMapping = $this->mappingService->updateMapping($programCategoryMapping, $request->validated());
<<<<<<< HEAD
        return $this->successResponse(new ProgramCategoryMappingResource($updatedMapping));
=======
        return new ProgramCategoryMappingResource($updatedMapping);
>>>>>>> dev-nada
    }

    public function destroy(ProgramCategoryMapping $programCategoryMapping)
    {
        $this->mappingService->deleteMapping($programCategoryMapping);
<<<<<<< HEAD
        return $this->deletedResponse();
=======
        return response()->noContent();
>>>>>>> dev-nada
    }
}