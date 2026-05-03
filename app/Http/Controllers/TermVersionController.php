<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreTermVersionRequest;
use App\Http\Requests\UpdateTermVersionRequest;
use App\Http\Resources\TermVersionResource;
use App\Models\TermVersion;

class TermVersionController extends Controller
{
    public function index() { return $this->successResponse(TermVersionResource::collection(TermVersion::all())); }
    public function store(StoreTermVersionRequest $request) { return $this->successResponse(new TermVersionResource(TermVersion::create($request->validated()))); }
    public function show(TermVersion $termVersion) { return $this->successResponse(new TermVersionResource($termVersion)); }
    public function update(UpdateTermVersionRequest $request, TermVersion $termVersion) { $termVersion->update($request->validated()); return $this->successResponse(new TermVersionResource($termVersion)); }
    public function destroy(TermVersion $termVersion) { $termVersion->delete(); return $this->deletedResponse(); }
}