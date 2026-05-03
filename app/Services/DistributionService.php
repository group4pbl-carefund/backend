<?php

namespace App\Services;

use App\Models\Distribution;

class DistributionService
{
    /**
     * Mengambil semua data distribusi beserta relasi programnya.
     */
    public function getAll()
    {
        return Distribution::with(['program'])->latest()->get();
    }

    /**
     * Menyimpan data distribusi baru ke database.
     */
    public function store(array $data)
    {
        return Distribution::create($data);
    }
}