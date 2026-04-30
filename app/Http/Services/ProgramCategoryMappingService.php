<?php

namespace App\Services;

use App\Models\ProgramCategoryMapping;
use Illuminate\Database\Eloquent\Collection;

class ProgramCategoryMappingService
{
    public function getAllMappings(): Collection
    {
        // Mengambil data mapping beserta relasi nama program dan kategorinya
        return ProgramCategoryMapping::with(['program', 'category'])->get();
    }

    public function createMapping(array $data): ProgramCategoryMapping
    {
        return ProgramCategoryMapping::create($data);
    }

    public function updateMapping(ProgramCategoryMapping $mapping, array $data): ProgramCategoryMapping
    {
        $mapping->update($data);
        return $mapping;
    }

    public function deleteMapping(ProgramCategoryMapping $mapping): bool
    {
        return $mapping->delete();
    }
}