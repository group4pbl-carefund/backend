<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use App\Http\Resources\ProgramResource;
use App\Models\Program;

class ProgramController extends Controller
{
    public function index()
    {
        return ProgramResource::collection(Program::all());
    }

    public function store(StoreProgramRequest $request)
    {
        return new ProgramResource(Program::create($request->validated()));
    }

    public function show(Program $program)
    {
        return new ProgramResource($program);
    }

    public function update(UpdateProgramRequest $request, Program $program)
    {
        $program->update($request->validated());
        return new ProgramResource($program);
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return response()->noContent();
    }
}