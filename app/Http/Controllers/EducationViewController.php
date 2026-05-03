<?php
namespace App\Http\Controllers;
use App\Models\EducationView;
use Illuminate\Http\Request;

class EducationViewController extends Controller {
    public function index() { return $this->successResponse(EducationView::all()); }
    public function store(Request $request) {
        $validated = $request->validate(['user_id' => 'required|exists:users,id', 'article_id' => 'required|exists:education_articles,article_id']);
        $validated['viewed_at'] = now();
        return $this->successResponse(EducationView::create($validated), 'Created', 201);
    }
    public function show(EducationView $educationView) { return $this->successResponse($educationView); }
}