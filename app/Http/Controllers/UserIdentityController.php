<?php
namespace App\Http\Controllers;

use App\Http\Requests\UserIdentity\StoreUserIdentityRequest;
use App\Http\Requests\UserIdentity\UpdateUserIdentityRequest;
use App\Http\Resources\UserIdentityResource;
use App\Models\UserIdentity;

class UserIdentityController extends Controller
{
    public function index() { return $this->successResponse(UserIdentityResource::collection(UserIdentity::all())); }
    public function store(StoreUserIdentityRequest $request) { return $this->successResponse(new UserIdentityResource(UserIdentity::create($request->validated()))); }
    public function show(UserIdentity $userIdentity) { return $this->successResponse(new UserIdentityResource($userIdentity)); }
    public function update(UpdateUserIdentityRequest $request, UserIdentity $userIdentity) { $userIdentity->update($request->validated()); return $this->successResponse(new UserIdentityResource($userIdentity)); }
    public function destroy(UserIdentity $userIdentity) { $userIdentity->delete(); return $this->deletedResponse(); }
}