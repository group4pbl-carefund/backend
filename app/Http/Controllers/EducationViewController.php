<?php
namespace App\Http\Controllers;
use App\Models\EducationView;
use Illuminate\Http\Request;

class EducationViewController extends Controller {

    /**
     * Menampilkan riwayat tampilan artikel.
     *
     * Mengambil semua data statistik kunjungan artikel edukasi.
     */
    public function index()
    {
        return $this->successResponse(EducationView::all());
    }

    /**
     * Mencatat kunjungan artikel.
     *
     * Membuat record baru saat pengguna melihat sebuah artikel edukasi.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'article_id' => 'required|exists:education_articles,article_id'
        ]);
        $validated['viewed_at'] = now();
        return $this->successResponse(EducationView::create($validated), 'Created', 201);
    }

    /**
     * Menampilkan detail kunjungan.
     *
     * Mengambil informasi spesifik dari satu record kunjungan artikel.
     */
    public function show(EducationView $educationView)
    {
        return $this->successResponse($educationView);
    }
}