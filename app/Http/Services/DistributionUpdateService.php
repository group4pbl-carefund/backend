<?php

namespace App\Services;

use App\Models\DistributionUpdate;

class DistributionUpdateService
{
    public function getAll()
    {
        return DistributionUpdate::with('distribution')->latest()->get();
    }

    public function store(array $data)
    {
        return DistributionUpdate::create($data);
    }
}