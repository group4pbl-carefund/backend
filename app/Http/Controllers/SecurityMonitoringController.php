<?php
namespace App\Http\Controllers;
use App\Models\SecurityMonitoring;
use Illuminate\Http\Request;

class SecurityMonitoringController extends Controller {
    public function index() { return response()->json(SecurityMonitoring::all()); }
    public function show(SecurityMonitoring $securityMonitoring) { return response()->json($securityMonitoring); }
}