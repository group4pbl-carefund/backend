<?php

namespace App\Http\Controllers;

use App\Http\Requests\Program\StoreProgramRequest;
use App\Http\Requests\Program\UpdateProgramRequest;
use App\Http\Resources\ProgramResource;
use App\Models\Program;

class ProgramController extends Controller
{

    /**
     * Menampilkan daftar program.
     *
     * Mengambil semua data program donasi yang tersedia.
     */
    public function index()
    {
        return $this->successResponse(ProgramResource::collection(Program::all()));
    }

    /**
     * Membuat program baru.
     *
     * Mendaftarkan program donasi baru ke dalam sistem.
     */
    public function store(StoreProgramRequest $request)
    {
        return $this->successResponse(new ProgramResource(Program::create($request->validated())));
    }

    /**
     * Menampilkan detail program.
     *
     * Mengambil detail spesifik dari sebuah program berdasarkan ID.
     */
    public function show(Program $program)
    {
        return $this->successResponse(new ProgramResource($program));
    }

    /**
     * Memperbarui data program.
     *
     * Mengubah informasi pada program yang sudah ada.
     */
    public function update(UpdateProgramRequest $request, Program $program)
    {
        $program->update($request->validated());

        return $this->successResponse(new ProgramResource($program));
    }

    /**
     * Menghapus program.
     *
     * Menghapus data program dari sistem secara permanen.
     */
    public function destroy(Program $program)
    {
        $program->delete();

        return $this->deletedResponse();
    }
}
