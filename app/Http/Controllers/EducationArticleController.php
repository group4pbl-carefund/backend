<?php
namespace App\Http\Controllers;

use App\Http\Requests\EducationArticle\StoreEducationArticleRequest;
use App\Http\Requests\EducationArticle\UpdateEducationArticleRequest;
use App\Http\Resources\EducationArticleResource;
use App\Models\EducationArticle;

class EducationArticleController extends Controller
{

    /**
     * Menampilkan daftar data.
     *
     * Endpoint ini mengembalikan semua record yang tersedia.
     */
    public function index() { return $this->successResponse(EducationArticleResource::collection(EducationArticle::all())); }

    /**
     * Menambahkan data baru.
     *
     * Endpoint ini digunakan untuk membuat record baru di database.
     */
    public function store(StoreEducationArticleRequest $request) { return $this->successResponse(new EducationArticleResource(EducationArticle::create($request->validated()))); }

    /**
     * Menampilkan detail data.
     *
     * Endpoint ini mengembalikan detail spesifik dari sebuah record berdasarkan ID.
     */
    public function show(EducationArticle $educationArticle) { return $this->successResponse(new EducationArticleResource($educationArticle)); }

    /**
     * Memperbarui data.
     *
     * Endpoint ini digunakan untuk mengupdate record yang sudah ada di database.
     */
    public function update(UpdateEducationArticleRequest $request, EducationArticle $educationArticle) { $educationArticle->update($request->validated()); return $this->successResponse(new EducationArticleResource($educationArticle)); }

    /**
     * Menghapus data.
     *
     * Endpoint ini digunakan untuk menghapus record dari database secara permanen.
     */
    public function destroy(EducationArticle $educationArticle) { $educationArticle->delete(); return $this->deletedResponse(); }
}