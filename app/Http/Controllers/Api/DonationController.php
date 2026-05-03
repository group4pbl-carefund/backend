<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Donation\StoreDonationRequest;
use App\Http\Resources\DonationResource;
use App\Services\DonationService;
use Illuminate\Http\JsonResponse;

class DonationController extends Controller
{
    protected $donationService;

    public function __construct(DonationService $donationService)
    {
        $this->donationService = $donationService;
    }

    public function index()
    {
        $donations = $this->donationService->getAll();
        return DonationResource::collection($donations);
    }

    public function store(StoreDonationRequest $request): JsonResponse
    {
        $donation = $this->donationService->store($request->validated());
        
        return response()->json([
            'success' => true,
            'message' => 'Donasi berhasil diproses',
            'data'    => new DonationResource($donation)
        ], 201);
    }
}