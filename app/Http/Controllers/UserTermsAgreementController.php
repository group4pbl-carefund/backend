<?php
namespace App\Http\Controllers;
use App\Models\UserTermsAgreement;
use Illuminate\Http\Request;

class UserTermsAgreementController extends Controller {
    public function index() { return response()->json(UserTermsAgreement::all()); }
    public function store(Request $request) {
        $validated = $request->validate(['user_id' => 'required|exists:users,id', 'version_id' => 'required|exists:term_versions,version_id', 'ip_address' => 'required|string']);
        $validated['agreed_at'] = now();
        return response()->json(UserTermsAgreement::create($validated), 201);
    }
    public function show(UserTermsAgreement $userTermsAgreement) { return response()->json($userTermsAgreement); }
}