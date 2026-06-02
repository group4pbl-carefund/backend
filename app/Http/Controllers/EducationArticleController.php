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
        return $this->successResponse(EducationArticleResource::collection(EducationArticle::with('author')->withCount('views')->get()));
    }

    /**
     * Membuat artikel edukasi baru.
     *
     * Menambahkan artikel edukasi baru ke dalam sistem.
     */
    public function store(StoreEducationArticleRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('articles', 'public');
            $data['thumbnail_url'] = '/storage/' . $path;
        }

        return $this->successResponse(new EducationArticleResource(EducationArticle::create($data)));
    }

    /**
     * Menampilkan detail artikel.
     *
     * Mengambil isi lengkap dari sebuah artikel edukasi berdasarkan ID.
     */
    public function show($id)
    {
        $educationArticle = EducationArticle::with('author')->withCount('views')->findOrFail($id);
        return $this->successResponse(new EducationArticleResource($educationArticle));
    }

    /**
     * Memperbarui data artikel.
     *
     * Mengubah informasi atau konten pada artikel yang sudah ada.
     */
    public function update(UpdateEducationArticleRequest $request, $id)
    {
        $educationArticle = EducationArticle::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('articles', 'public');
            $data['thumbnail_url'] = '/storage/' . $path;
        }

        $educationArticle->update($data);
        return $this->successResponse(new EducationArticleResource($educationArticle));
    }

    /**
     * Menghapus artikel.
     *
     * Menghapus data artikel edukasi dari database secara permanen.
     */
    public function destroy($id)
    {
        $educationArticle = EducationArticle::findOrFail($id);
        $educationArticle->delete();
        return $this->deletedResponse();
    }
}