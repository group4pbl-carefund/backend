<?php
namespace App\Http\Controllers;
use App\Models\UserTermsAgreement;
use Illuminate\Http\Request;

class UserTermsAgreementController extends Controller {

    /**
     * Menampilkan daftar persetujuan syarat dan ketentuan.
     *
     * Mengambil semua data pengguna yang telah menyetujui versi T&C tertentu.
     */
    public function index()
    {
        return $this->successResponse(UserTermsAgreement::all());
    }

    /**
     * Mencatat persetujuan T&C baru.
     *
     * Menyimpan persetujuan pengguna terhadap syarat dan ketentuan aplikasi.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'version_id' => 'required|exists:term_versions,version_id',
            'ip_address' => 'required|string'
        ]);
        $validated['agreed_at'] = now();
        return $this->successResponse(UserTermsAgreement::create($validated), 'Created', 201);
    }

    /**
     * Menampilkan detail persetujuan.
     *
     * Mengambil informasi spesifik dari satu record persetujuan T&C berdasarkan ID.
     */
    public function show(UserTermsAgreement $userTermsAgreement)
    {
        return $this->successResponse($userTermsAgreement);
    }
}