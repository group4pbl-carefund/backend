<?php

namespace App\Services;

use App\Models\ProgramCategory;
use Illuminate\Database\Eloquent\Collection;

class ProgramCategoryService
{
    public function getAllCategories(): Collection
    {
        return ProgramCategory::all();
    }

    public function createCategory(array $data): ProgramCategory
    {
        return ProgramCategory::create($data);
    }

    public function updateCategory(ProgramCategory $category, array $data): ProgramCategory
    {
        $category->update($data);
        return $category;
    }

    public function deleteCategory(ProgramCategory $category): bool
    {
        return $category->delete();
    }
}