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
        return $this->successResponse(ProgramResource::collection(Program::with(['user', 'campaign', 'distribution'])->get()));
    }

    /**
     * Membuat program baru.
     *
     * Mendaftarkan program donasi baru ke dalam sistem.
     */
    public function store(StoreProgramRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('programs', 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        $documents = [];
        if ($request->hasFile('ktp_file')) {
            $path = $request->file('ktp_file')->store('programs/documents', 'public');
            $documents[] = ['name' => 'KTP', 'url' => '/storage/' . $path];
        }
        if ($request->hasFile('selfie_file')) {
            $path = $request->file('selfie_file')->store('programs/documents', 'public');
            $documents[] = ['name' => 'Selfie KTP', 'url' => '/storage/' . $path];
        }
        if ($request->hasFile('supporting_docs')) {
            foreach ($request->file('supporting_docs') as $file) {
                $path = $file->store('programs/documents', 'public');
                $documents[] = ['name' => $file->getClientOriginalName(), 'url' => '/storage/' . $path];
            }
        }
        if (!empty($documents)) {
            $data['documents'] = $documents;
        }

        $program = Program::create($data);

        \App\Models\ProgramCampaign::create([
            'program_id' => $program->program_id,
            'current_amount' => 0,
            'available_balance' => 0,
            'donor_count' => 0
        ]);

        return $this->successResponse(new ProgramResource($program));
    }

    /**
     * Menampilkan detail program.
     *
     * Mengambil detail spesifik dari sebuah program berdasarkan ID.
     */
    public function show(Program $program)
    {
        return $this->successResponse(new ProgramResource($program->load(['user', 'campaign', 'distribution'])));
    }

    /**
     * Memperbarui data program.
     *
     * Mengubah informasi pada program yang sudah ada.
     */
    public function update(UpdateProgramRequest $request, Program $program)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('programs', 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        $documents = $program->documents ?? [];
        if ($request->hasFile('ktp_file')) {
            $path = $request->file('ktp_file')->store('programs/documents', 'public');
            $documents[] = ['name' => 'KTP', 'url' => '/storage/' . $path];
        }
        if ($request->hasFile('selfie_file')) {
            $path = $request->file('selfie_file')->store('programs/documents', 'public');
            $documents[] = ['name' => 'Selfie KTP', 'url' => '/storage/' . $path];
        }
        if ($request->hasFile('supporting_docs')) {
            foreach ($request->file('supporting_docs') as $file) {
                $path = $file->store('programs/documents', 'public');
                $documents[] = ['name' => $file->getClientOriginalName(), 'url' => '/storage/' . $path];
            }
        }
        if (!empty($documents)) {
            $data['documents'] = $documents;
        }

        $program->update($data);

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

    /**
     * Menambahkan update kabar terbaru ke program.
     */
    public function addUpdate(\Illuminate\Http\Request $request, Program $program)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $updates = $program->updates ?? [];
        $newUpdate = [
            'id' => time(),
            'title' => $request->title,
            'content' => $request->content,
            'date' => now()->toIso8601String(),
            'updated_by' => $request->user()->id,
        ];
        array_unshift($updates, $newUpdate);

        $program->update(['updates' => $updates]);

        return $this->successResponse(['update' => $newUpdate]);
    }
}
