<?php
namespace App\Http\Controllers;
use App\Models\UserSession;
use Illuminate\Http\Request;

class UserSessionController extends Controller {
    public function index() { return $this->successResponse(UserSession::all()); }
    public function show(UserSession $userSession) { return $this->successResponse($userSession); }
    public function destroy(UserSession $userSession) { $userSession->delete(); return $this->deletedResponse(); }
}