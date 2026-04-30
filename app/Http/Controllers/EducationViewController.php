<?php
namespace App\Http\Controllers;
use App\Models\EducationView;
use Illuminate\Http\Request;

class EducationViewController extends Controller {
    public function index() { return response()->json(EducationView::all()); }
    public function store(Request $request) {
        $validated = $request->validate(['user_id' => 'required|exists:users,id', 'article_id' => 'required|exists:education_articles,article_id']);
        $validated['viewed_at'] = now();
        return response()->json(EducationView::create($validated), 201);
    }
    public function show(EducationView $educationView) { return response()->json($educationView); }
}