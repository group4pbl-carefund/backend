<?php
namespace App\Http\Controllers;
use App\Models\SecurityMonitoring;
use Illuminate\Http\Request;

class SecurityMonitoringController extends Controller {

    /**
     * Menampilkan daftar log keamanan.
     *
     * Mengambil semua catatan aktivitas keamanan sistem.
     */
    public function index()
    {
        return $this->successResponse(SecurityMonitoring::all());
    }

    /**
     * Menampilkan detail log keamanan.
     *
     * Mengambil informasi detail dari satu aktivitas keamanan berdasarkan ID.
     */
    public function show(SecurityMonitoring $securityMonitoring)
    {
        return $this->successResponse($securityMonitoring);
    }
}