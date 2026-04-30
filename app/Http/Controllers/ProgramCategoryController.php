<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProgramCategoryRequest;
use App\Http\Requests\UpdateProgramCategoryRequest;
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
        return ProgramCategoryResource::collection($this->categoryService->getAllCategories());
    }

    public function store(StoreProgramCategoryRequest $request)
    {
        $category = $this->categoryService->createCategory($request->validated());
        return new ProgramCategoryResource($category);
    }

    public function show(ProgramCategory $programCategory)
    {
        return new ProgramCategoryResource($programCategory);
    }

    public function update(UpdateProgramCategoryRequest $request, ProgramCategory $programCategory)
    {
        $updatedCategory = $this->categoryService->updateCategory($programCategory, $request->validated());
        return new ProgramCategoryResource($updatedCategory);
    }

    public function destroy(ProgramCategory $programCategory)
    {
        $this->categoryService->deleteCategory($programCategory);
        return response()->noContent();
    }
}