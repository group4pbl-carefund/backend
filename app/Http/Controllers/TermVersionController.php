<?php
namespace App\Http\Controllers;

use App\Http\Requests\TermVersion\StoreTermVersionRequest;
use App\Http\Requests\TermVersion\UpdateTermVersionRequest;
use App\Http\Resources\TermVersionResource;
use App\Models\TermVersion;

class TermVersionController extends Controller
{

    /**
     * Menampilkan daftar data.
     *
     * Endpoint ini mengembalikan semua record yang tersedia.
     */
    public function index() { return $this->successResponse(TermVersionResource::collection(TermVersion::all())); }

    /**
     * Menambahkan data baru.
     *
     * Endpoint ini digunakan untuk membuat record baru di database.
     */
    public function store(StoreTermVersionRequest $request) { return $this->successResponse(new TermVersionResource(TermVersion::create($request->validated()))); }

    /**
     * Menampilkan detail data.
     *
     * Endpoint ini mengembalikan detail spesifik dari sebuah record berdasarkan ID.
     */
    public function show(TermVersion $termVersion) { return $this->successResponse(new TermVersionResource($termVersion)); }

    /**
     * Memperbarui data.
     *
     * Endpoint ini digunakan untuk mengupdate record yang sudah ada di database.
     */
    public function update(UpdateTermVersionRequest $request, TermVersion $termVersion) { $termVersion->update($request->validated()); return $this->successResponse(new TermVersionResource($termVersion)); }

    /**
     * Menghapus data.
     *
     * Endpoint ini digunakan untuk menghapus record dari database secara permanen.
     */
    public function destroy(TermVersion $termVersion) { $termVersion->delete(); return $this->deletedResponse(); }
}