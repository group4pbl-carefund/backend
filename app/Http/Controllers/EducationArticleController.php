<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreEducationArticleRequest;
use App\Http\Requests\UpdateEducationArticleRequest;
use App\Http\Resources\EducationArticleResource;
use App\Models\EducationArticle;

class EducationArticleController extends Controller
{
    public function index() { return $this->successResponse(EducationArticleResource::collection(EducationArticle::all())); }
    public function store(StoreEducationArticleRequest $request) { return $this->successResponse(new EducationArticleResource(EducationArticle::create($request->validated()))); }
    public function show(EducationArticle $educationArticle) { return $this->successResponse(new EducationArticleResource($educationArticle)); }
    public function update(UpdateEducationArticleRequest $request, EducationArticle $educationArticle) { $educationArticle->update($request->validated()); return $this->successResponse(new EducationArticleResource($educationArticle)); }
    public function destroy(EducationArticle $educationArticle) { $educationArticle->delete(); return $this->deletedResponse(); }
}