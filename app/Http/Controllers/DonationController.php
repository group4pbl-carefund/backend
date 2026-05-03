<?php

namespace App\Http\Controllers;

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
        return $this->successResponse(DonationResource::collection($donations));
    }

    public function store(StoreDonationRequest $request): JsonResponse
    {
        $donation = $this->donationService->store($request->validated());
        
        return $this->successResponse(new DonationResource($donation), 'Donasi berhasil diproses', 201);
    }
}