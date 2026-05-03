<?php
namespace App\Http\Controllers;

use App\Http\Requests\UserIdentity\StoreUserIdentityRequest;
use App\Http\Requests\UserIdentity\UpdateUserIdentityRequest;
use App\Http\Resources\UserIdentityResource;
use App\Models\UserIdentity;

class UserIdentityController extends Controller
{

    /**
     * Menampilkan daftar data.
     *
     * Endpoint ini mengembalikan semua record yang tersedia.
     */
    public function index() { return $this->successResponse(UserIdentityResource::collection(UserIdentity::all())); }

    /**
     * Menambahkan data baru.
     *
     * Endpoint ini digunakan untuk membuat record baru di database.
     */
    public function store(StoreUserIdentityRequest $request) { return $this->successResponse(new UserIdentityResource(UserIdentity::create($request->validated()))); }

    /**
     * Menampilkan detail data.
     *
     * Endpoint ini mengembalikan detail spesifik dari sebuah record berdasarkan ID.
     */
    public function show(UserIdentity $userIdentity) { return $this->successResponse(new UserIdentityResource($userIdentity)); }

    /**
     * Memperbarui data.
     *
     * Endpoint ini digunakan untuk mengupdate record yang sudah ada di database.
     */
    public function update(UpdateUserIdentityRequest $request, UserIdentity $userIdentity) { $userIdentity->update($request->validated()); return $this->successResponse(new UserIdentityResource($userIdentity)); }

    /**
     * Menghapus data.
     *
     * Endpoint ini digunakan untuk menghapus record dari database secara permanen.
     */
    public function destroy(UserIdentity $userIdentity) { $userIdentity->delete(); return $this->deletedResponse(); }
}