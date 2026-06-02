<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

Route::get('/public-stats', [App\Http\Controllers\DashboardController::class, 'publicStats']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/resend-otp', [AuthController::class, 'resendOtp']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Public Program Campaigns
Route::get('program-campaigns', [ProgramCampaignController::class, 'index']);
Route::get('program-campaigns/{programCampaign}', [ProgramCampaignController::class, 'show']);
Route::get('program-campaigns/{programCampaign}/donors', [ProgramCampaignController::class, 'donors']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('user-identities', UserIdentityController::class);
    Route::apiResource('user-sessions', UserSessionController::class)->only(['index', 'show', 'destroy']);
    Route::apiResource('user-terms-agreements', UserTermsAgreementController::class)->only(['index', 'store', 'show']);
    Route::apiResource('education-views', EducationViewController::class)->only(['index', 'store', 'show']);
    
    // Dashboard route
    Route::post('/profile/avatar', [UserController::class, 'updateAvatar']);
    Route::patch('/profile', [UserController::class, 'updateProfile']);
    Route::post('/upload-editor-image', [\App\Http\Controllers\UserController::class, 'uploadEditorImage']);
    
    Route::get('/dashboard', [DashboardController::class, 'index']);
    
    Route::apiResource('programs', ProgramController::class);
    Route::post('programs/{program}/updates', [ProgramController::class, 'addUpdate']);
    Route::post('program-campaigns/{programCampaign}/extend', [ProgramCampaignController::class, 'extend']);
    Route::apiResource('program-campaigns', ProgramCampaignController::class)->except(['index', 'show']);
    Route::patch('donations/{donation}/complete', [\App\Http\Controllers\DonationController::class, 'complete']);
    Route::patch('donations/{donation}/cancel', [\App\Http\Controllers\DonationController::class, 'cancel']);
    Route::apiResource('donations', \App\Http\Controllers\DonationController::class);
    Route::apiResource('distributions', DistributionController::class);
    Route::apiResource('payment-logs', PaymentLogController::class);

    // Index accessible to all authenticated users
    Route::get('distribution-updates', [DistributionUpdateController::class, 'index']);
    Route::get('program-categories', [ProgramCategoryController::class, 'index']);
    Route::get('program-category-mappings', [ProgramCategoryMappingController::class, 'index']);
    
    // Allow all authenticated users to read education articles
    Route::apiResource('education-articles', EducationArticleController::class)->only(['index', 'show']);

    // Allow all authenticated users to read term versions
    Route::apiResource('term-versions', TermVersionController::class)->only(['index', 'show']);

    Route::middleware('admin')->group(function () {
        Route::apiResource('users', UserController::class);
        Route::apiResource('term-versions', TermVersionController::class)->except(['index', 'show']);
        Route::apiResource('security-monitorings', SecurityMonitoringController::class)->only(['index', 'show']);
        // Admin-only methods for these resources
        Route::apiResource('education-articles', EducationArticleController::class)->except(['index', 'show']);
        Route::apiResource('distribution-updates', DistributionUpdateController::class)->except(['index']);
        Route::apiResource('program-categories', ProgramCategoryController::class)->except(['index']);
        Route::apiResource('program-category-mappings', ProgramCategoryMappingController::class)->except(['index']);
    });
});
