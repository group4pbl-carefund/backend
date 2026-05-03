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

    /**
     * Menampilkan daftar data.
     *
     * Endpoint ini mengembalikan semua record yang tersedia.
     */
    public function index()
    {
        return $this->successResponse(ProgramCategoryResource::collection($this->categoryService->getAllCategories()));
    }

    /**
     * Menambahkan data baru.
     *
     * Endpoint ini digunakan untuk membuat record baru di database.
     */
    public function store(StoreProgramCategoryRequest $request)
    {
        $category = $this->categoryService->createCategory($request->validated());

        return $this->successResponse(new ProgramCategoryResource($category));
    }

    /**
     * Menampilkan detail data.
     *
     * Endpoint ini mengembalikan detail spesifik dari sebuah record berdasarkan ID.
     */
    public function show(ProgramCategory $programCategory)
    {
        return $this->successResponse(new ProgramCategoryResource($programCategory));
    }

    /**
     * Memperbarui data.
     *
     * Endpoint ini digunakan untuk mengupdate record yang sudah ada di database.
     */
    public function update(UpdateProgramCategoryRequest $request, ProgramCategory $programCategory)
    {
        $updatedCategory = $this->categoryService->updateCategory($programCategory, $request->validated());

        return $this->successResponse(new ProgramCategoryResource($updatedCategory));
    }

    /**
     * Menghapus data.
     *
     * Endpoint ini digunakan untuk menghapus record dari database secara permanen.
     */
    public function destroy(ProgramCategory $programCategory)
    {
        $this->categoryService->deleteCategory($programCategory);

        return $this->deletedResponse();
    }
}
