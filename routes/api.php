<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserIdentityController;
use App\Http\Controllers\UserSessionController;
use App\Http\Controllers\UserTermsAgreementController;
use App\Http\Controllers\TermVersionController;
use App\Http\Controllers\SecurityMonitoringController;
use App\Http\Controllers\EducationArticleController;
use App\Http\Controllers\EducationViewController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ProgramCampaignController;
use App\Http\Controllers\ProgramCategoryController;
use App\Http\Controllers\ProgramCategoryMappingController;
use App\Http\Controllers\Api\DonationController;
use App\Http\Controllers\Api\DistributionController;
use App\Http\Controllers\Api\PaymentLogController;
use App\Http\Controllers\Api\DistributionUpdateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('users', UserController::class);
    Route::apiResource('user-identities', UserIdentityController::class);
    Route::apiResource('user-sessions', UserSessionController::class)->only(['index', 'show', 'destroy']);
    Route::apiResource('user-terms-agreements', UserTermsAgreementController::class)->only(['index', 'store', 'show']);
    Route::apiResource('term-versions', TermVersionController::class);
    Route::apiResource('security-monitorings', SecurityMonitoringController::class)->only(['index', 'show']);
    Route::apiResource('education-articles', EducationArticleController::class);
    Route::apiResource('education-views', EducationViewController::class)->only(['index', 'store', 'show']);
    Route::apiResource('programs', ProgramController::class);
    Route::apiResource('program-campaigns', ProgramCampaignController::class);
    Route::apiResource('program-categories', ProgramCategoryController::class);
    //Route::apiResource('program-category-mappings', ProgramCategoryMappingController::class);
    
    Route::apiResource('donations', DonationController::class);
    Route::apiResource('distributions', DistributionController::class);
    Route::apiResource('payment-logs', PaymentLogController::class);
    Route::apiResource('distribution-updates', DistributionUpdateController::class);
});