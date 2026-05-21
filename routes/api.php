<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DistributionController;
use App\Http\Controllers\DistributionUpdateController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\EducationArticleController;
use App\Http\Controllers\EducationViewController;
use App\Http\Controllers\PaymentLogController;
use App\Http\Controllers\ProgramCampaignController;
use App\Http\Controllers\ProgramCategoryController;
use App\Http\Controllers\ProgramCategoryMappingController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SecurityMonitoringController;
use App\Http\Controllers\TermVersionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserIdentityController;
use App\Http\Controllers\UserSessionController;
use App\Http\Controllers\UserTermsAgreementController;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json([
        'name' => 'Carefund API',
        'status' => 'OK',
        'timestamp' => now()->toIso8601String()
    ]);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/resend-otp', [AuthController::class, 'resendOtp']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('user-identities', UserIdentityController::class);
    Route::apiResource('user-sessions', UserSessionController::class)->only(['index', 'show', 'destroy']);
    Route::apiResource('user-terms-agreements', UserTermsAgreementController::class)->only(['index', 'store', 'show']);
    Route::apiResource('education-views', EducationViewController::class)->only(['index', 'store', 'show']);
    Route::apiResource('programs', ProgramController::class);
    Route::post('program-campaigns/{programCampaign}/extend', [ProgramCampaignController::class, 'extend']);
    Route::apiResource('program-campaigns', ProgramCampaignController::class);
    Route::apiResource('donations', DonationController::class);
    Route::apiResource('distributions', DistributionController::class);
    Route::apiResource('payment-logs', PaymentLogController::class);

    // Index accessible to all authenticated users
    Route::get('distribution-updates', [DistributionUpdateController::class, 'index']);
    Route::get('program-categories', [ProgramCategoryController::class, 'index']);
    Route::get('program-category-mappings', [ProgramCategoryMappingController::class, 'index']);

    Route::middleware('admin')->group(function () {
        Route::apiResource('users', UserController::class);
        Route::apiResource('term-versions', TermVersionController::class);
        Route::apiResource('security-monitorings', SecurityMonitoringController::class)->only(['index', 'show']);
        Route::apiResource('education-articles', EducationArticleController::class);
        // Admin-only methods for these resources
        Route::apiResource('distribution-updates', DistributionUpdateController::class)->except(['index']);
        Route::apiResource('program-categories', ProgramCategoryController::class)->except(['index']);
        Route::apiResource('program-category-mappings', ProgramCategoryMappingController::class)->except(['index']);
    });
});
