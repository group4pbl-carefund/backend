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
     * Menampilkan daftar kategori program.
     *
     * Mengambil semua jenis kategori yang tersedia untuk pengelompokan program.
     */
    public function index()
    {
        return $this->successResponse(ProgramCategoryResource::collection($this->categoryService->getAllCategories()));
    }

    /**
     * Membuat kategori baru.
     *
     * Menambahkan jenis kategori baru ke dalam sistem.
     */
    public function store(StoreProgramCategoryRequest $request)
    {
        $category = $this->categoryService->createCategory($request->validated());

        return $this->successResponse(new ProgramCategoryResource($category));
    }

    /**
     * Menampilkan detail kategori.
     *
     * Mengambil informasi lengkap dari sebuah kategori berdasarkan ID.
     */
    public function show(ProgramCategory $programCategory)
    {
        return $this->successResponse(new ProgramCategoryResource($programCategory));
    }

    /**
     * Memperbarui data kategori.
     *
     * Mengubah informasi pada kategori yang sudah ada.
     */
    public function update(UpdateProgramCategoryRequest $request, ProgramCategory $programCategory)
    {
        $updatedCategory = $this->categoryService->updateCategory($programCategory, $request->validated());

        return $this->successResponse(new ProgramCategoryResource($updatedCategory));
    }

    /**
     * Menghapus kategori.
     *
     * Menghapus data kategori dari database secara permanen.
     */
    public function destroy(ProgramCategory $programCategory)
    {
        $this->categoryService->deleteCategory($programCategory);

        return $this->deletedResponse();
    }
}
