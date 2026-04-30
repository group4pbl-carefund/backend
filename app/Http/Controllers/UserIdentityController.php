<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreUserIdentityRequest;
use App\Http\Requests\UpdateUserIdentityRequest;
use App\Http\Resources\UserIdentityResource;
use App\Models\UserIdentity;

class UserIdentityController extends Controller
{
    public function index() { return UserIdentityResource::collection(UserIdentity::all()); }
    public function store(StoreUserIdentityRequest $request) { return new UserIdentityResource(UserIdentity::create($request->validated())); }
    public function show(UserIdentity $userIdentity) { return new UserIdentityResource($userIdentity); }
    public function update(UpdateUserIdentityRequest $request, UserIdentity $userIdentity) { $userIdentity->update($request->validated()); return new UserIdentityResource($userIdentity); }
    public function destroy(UserIdentity $userIdentity) { $userIdentity->delete(); return response()->noContent(); }
}