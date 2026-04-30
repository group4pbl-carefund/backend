<?php
namespace App\Http\Controllers;
use App\Models\UserSession;
use Illuminate\Http\Request;

class UserSessionController extends Controller {
    public function index() { return response()->json(UserSession::all()); }
    public function show(UserSession $userSession) { return response()->json($userSession); }
    public function destroy(UserSession $userSession) { $userSession->delete(); return response()->noContent(); }
}