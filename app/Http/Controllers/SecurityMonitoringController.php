<?php
namespace App\Http\Controllers;
use App\Models\SecurityMonitoring;
use Illuminate\Http\Request;

class SecurityMonitoringController extends Controller {

    /**
     * Menampilkan daftar data.
     *
     * Endpoint ini mengembalikan semua record yang tersedia.
     */
    public function index() { return $this->successResponse(SecurityMonitoring::all()); }

    /**
     * Menampilkan detail data.
     *
     * Endpoint ini mengembalikan detail spesifik dari sebuah record berdasarkan ID.
     */
    public function show(SecurityMonitoring $securityMonitoring) { return $this->successResponse($securityMonitoring); }
}