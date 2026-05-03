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
        return $this->successResponse(ProgramResource::collection(Program::all()));
    }

    public function store(StoreProgramRequest $request)
    {
        return $this->successResponse(new ProgramResource(Program::create($request->validated())));
    }

    public function show(Program $program)
    {
        return $this->successResponse(new ProgramResource($program));
    }

    public function update(UpdateProgramRequest $request, Program $program)
    {
        $program->update($request->validated());

        return $this->successResponse(new ProgramResource($program));
    }

    public function destroy(Program $program)
    {
        $program->delete();

        return $this->deletedResponse();
    }
}
