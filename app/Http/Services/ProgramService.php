<?php

namespace App\Services;

use App\Models\Program;
use Illuminate\Database\Eloquent\Collection;

class ProgramService
{
    public function getAllPrograms(): Collection
    {
        return Program::all();
    }

    public function createProgram(array $data): Program
    {
        return Program::create($data);
    }

    public function updateProgram(Program $program, array $data): Program
    {
        $program->update($data);
        return $program;
    }

    public function deleteProgram(Program $program): bool
    {
        return $program->delete();
    }
}