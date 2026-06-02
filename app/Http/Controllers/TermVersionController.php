<?php
namespace App\Http\Controllers;

use App\Http\Requests\TermVersion\StoreTermVersionRequest;
use App\Http\Requests\TermVersion\UpdateTermVersionRequest;
use App\Http\Resources\TermVersionResource;
use App\Models\TermVersion;

class TermVersionController extends Controller
{

    /**
     * Menampilkan daftar versi syarat dan ketentuan.
     *
     * Mengambil semua riwayat perubahan syarat dan ketentuan (T&C).
     */
    public function index()
    {
        return $this->successResponse(TermVersion::all());
    }

    /**
     * Membuat versi T&C baru.
     *
     * Menambahkan versi baru untuk syarat dan ketentuan aplikasi.
     */
    public function store(StoreTermVersionRequest $request)
    {
        return $this->successResponse(TermVersion::create($request->validated()));
    }

    /**
     * Menampilkan detail versi T&C.
     *
     * Mengambil informasi lengkap dari satu versi syarat dan ketentuan berdasarkan ID.
     */
    public function show(TermVersion $termVersion)
    {
        return $this->successResponse($termVersion);
    }

    /**
     * Memperbarui data versi T&C.
     *
     * Mengubah isi atau informasi pada versi syarat dan ketentuan yang sudah ada.
     */
    public function update(UpdateTermVersionRequest $request, TermVersion $termVersion)
    {
        $termVersion->update($request->validated());
        return $this->successResponse($termVersion);
    }

    /**
     * Menghapus versi T&C.
     *
     * Menghapus record versi syarat dan ketentuan dari database secara permanen.
     */
    public function destroy(TermVersion $termVersion)
    {
        $termVersion->delete();
        return $this->deletedResponse();
    }
}