<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreEducationArticleRequest;
use App\Http\Requests\UpdateEducationArticleRequest;
use App\Http\Resources\EducationArticleResource;
use App\Models\EducationArticle;

class EducationArticleController extends Controller
{
    public function index() { return EducationArticleResource::collection(EducationArticle::all()); }
    public function store(StoreEducationArticleRequest $request) { return new EducationArticleResource(EducationArticle::create($request->validated())); }
    public function show(EducationArticle $educationArticle) { return new EducationArticleResource($educationArticle); }
    public function update(UpdateEducationArticleRequest $request, EducationArticle $educationArticle) { $educationArticle->update($request->validated()); return new EducationArticleResource($educationArticle); }
    public function destroy(EducationArticle $educationArticle) { $educationArticle->delete(); return response()->noContent(); }
}