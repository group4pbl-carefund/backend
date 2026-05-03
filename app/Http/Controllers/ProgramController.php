<?php

namespace App\Http\Controllers;

use App\Http\Requests\Program\StoreProgramRequest;
use App\Http\Requests\Program\UpdateProgramRequest;
use App\Http\Resources\ProgramResource;
use App\Models\Program;

class ProgramController extends Controller
{

    /**
     * Menampilkan daftar data.
     *
     * Endpoint ini mengembalikan semua record yang tersedia.
     */
    public function index()
    {
        return $this->successResponse(ProgramResource::collection(Program::all()));
    }

    /**
     * Menambahkan data baru.
     *
     * Endpoint ini digunakan untuk membuat record baru di database.
     */
    public function store(StoreProgramRequest $request)
    {
        return $this->successResponse(new ProgramResource(Program::create($request->validated())));
    }

    /**
     * Menampilkan detail data.
     *
     * Endpoint ini mengembalikan detail spesifik dari sebuah record berdasarkan ID.
     */
    public function show(Program $program)
    {
        return $this->successResponse(new ProgramResource($program));
    }

    /**
     * Memperbarui data.
     *
     * Endpoint ini digunakan untuk mengupdate record yang sudah ada di database.
     */
    public function update(UpdateProgramRequest $request, Program $program)
    {
        $program->update($request->validated());

        return $this->successResponse(new ProgramResource($program));
    }

    /**
     * Menghapus data.
     *
     * Endpoint ini digunakan untuk menghapus record dari database secara permanen.
     */
    public function destroy(Program $program)
    {
        $program->delete();

        return $this->deletedResponse();
    }
}
