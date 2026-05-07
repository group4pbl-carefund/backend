<?php
namespace App\Http\Controllers;

use App\Http\Requests\EducationArticle\StoreEducationArticleRequest;
use App\Http\Requests\EducationArticle\UpdateEducationArticleRequest;
use App\Http\Resources\EducationArticleResource;
use App\Models\EducationArticle;

class EducationArticleController extends Controller
{

    /**
     * Menampilkan daftar artikel edukasi.
     *
     * Mengambil semua artikel edukasi yang tersedia untuk pengguna.
     */
    public function index()
    {
        return $this->successResponse(EducationArticleResource::collection(EducationArticle::all()));
    }

    /**
     * Membuat artikel edukasi baru.
     *
     * Menambahkan artikel edukasi baru ke dalam sistem.
     */
    public function store(StoreEducationArticleRequest $request)
    {
        return $this->successResponse(new EducationArticleResource(EducationArticle::create($request->validated())));
    }

    /**
     * Menampilkan detail artikel.
     *
     * Mengambil isi lengkap dari sebuah artikel edukasi berdasarkan ID.
     */
    public function show(EducationArticle $educationArticle)
    {
        return $this->successResponse(new EducationArticleResource($educationArticle));
    }

    /**
     * Memperbarui data artikel.
     *
     * Mengubah informasi atau konten pada artikel yang sudah ada.
     */
    public function update(UpdateEducationArticleRequest $request, EducationArticle $educationArticle)
    {
        $educationArticle->update($request->validated());
        return $this->successResponse(new EducationArticleResource($educationArticle));
    }

    /**
     * Menghapus artikel.
     *
     * Menghapus data artikel edukasi dari database secara permanen.
     */
    public function destroy(EducationArticle $educationArticle)
    {
        $educationArticle->delete();
        return $this->deletedResponse();
    }
}