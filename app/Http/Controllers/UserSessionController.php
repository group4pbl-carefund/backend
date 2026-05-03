<?php
namespace App\Http\Controllers;
use App\Models\UserSession;
use Illuminate\Http\Request;

class UserSessionController extends Controller {

    /**
     * Menampilkan daftar data.
     *
     * Endpoint ini mengembalikan semua record yang tersedia.
     */
    public function index() { return $this->successResponse(UserSession::all()); }

    /**
     * Menampilkan detail data.
     *
     * Endpoint ini mengembalikan detail spesifik dari sebuah record berdasarkan ID.
     */
    public function show(UserSession $userSession) { return $this->successResponse($userSession); }

    /**
     * Menghapus data.
     *
     * Endpoint ini digunakan untuk menghapus record dari database secara permanen.
     */
    public function destroy(UserSession $userSession) { $userSession->delete(); return $this->deletedResponse(); }
}