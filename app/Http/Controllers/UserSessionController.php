<?php
namespace App\Http\Controllers;
use App\Models\UserSession;
use Illuminate\Http\Request;

class UserSessionController extends Controller {

    /**
     * Menampilkan daftar sesi pengguna.
     *
     * Mengambil semua riwayat sesi login pengguna yang aktif maupun yang sudah berakhir.
     */
    public function index()
    {
        return $this->successResponse(UserSession::all());
    }

    /**
     * Menampilkan detail sesi.
     *
     * Mengambil informasi spesifik dari sebuah record sesi pengguna berdasarkan ID.
     */
    public function show(UserSession $userSession)
    {
        return $this->successResponse($userSession);
    }

    /**
     * Menghapus sesi.
     *
     * Menghapus record sesi pengguna dari database secara permanen.
     */
    public function destroy(UserSession $userSession)
    {
        $userSession->delete();
        return $this->deletedResponse();
    }
}