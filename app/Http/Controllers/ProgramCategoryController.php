<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgramCategory\StoreProgramCategoryRequest;
use App\Http\Requests\ProgramCategory\UpdateProgramCategoryRequest;
use App\Http\Resources\ProgramCategoryResource;
use App\Models\ProgramCategory;
use App\Services\ProgramCategoryService;

class ProgramCategoryController extends Controller
{
    protected $categoryService;

    public function __construct(ProgramCategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return $this->successResponse(ProgramCategoryResource::collection($this->categoryService->getAllCategories()));
    }

    public function store(StoreProgramCategoryRequest $request)
    {
        $category = $this->categoryService->createCategory($request->validated());

        return $this->successResponse(new ProgramCategoryResource($category));
    }

    public function show(ProgramCategory $programCategory)
    {
        return $this->successResponse(new ProgramCategoryResource($programCategory));
    }

    public function update(UpdateProgramCategoryRequest $request, ProgramCategory $programCategory)
    {
        $updatedCategory = $this->categoryService->updateCategory($programCategory, $request->validated());

        return $this->successResponse(new ProgramCategoryResource($updatedCategory));
    }

    public function destroy(ProgramCategory $programCategory)
    {
        $this->categoryService->deleteCategory($programCategory);

        return $this->deletedResponse();
    }
}
