<?php
namespace App\Http\Controllers;
use App\Models\EducationView;
use Illuminate\Http\Request;

class EducationViewController extends Controller {

    /**
     * Menampilkan daftar data.
     *
     * Endpoint ini mengembalikan semua record yang tersedia.
     */
    public function index() { return $this->successResponse(EducationView::all()); }

    /**
     * Menambahkan data baru.
     *
     * Endpoint ini digunakan untuk membuat record baru di database.
     */
    public function store(Request $request) {
        $validated = $request->validate(['user_id' => 'required|exists:users,id', 'article_id' => 'required|exists:education_articles,article_id']);
        $validated['viewed_at'] = now();
        return $this->successResponse(EducationView::create($validated), 'Created', 201);
    }

    /**
     * Menampilkan detail data.
     *
     * Endpoint ini mengembalikan detail spesifik dari sebuah record berdasarkan ID.
     */
    public function show(EducationView $educationView) { return $this->successResponse($educationView); }
}