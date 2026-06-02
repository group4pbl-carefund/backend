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

    /**
     * Menampilkan daftar semua donasi.
     *
     * Mengambil riwayat donasi yang telah dilakukan oleh semua pengguna.
     */
    public function index()
    {
        $donations = $this->donationService->getAll();
        return $this->successResponse(DonationResource::collection($donations));
    }

    /**
     * Membuat donasi baru.
     *
     * Memproses transaksi donasi baru untuk program tertentu.
     */
    public function store(StoreDonationRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id; // Auto assign authenticated user

        $donation = $this->donationService->store($data);
        
        return $this->successResponse(new DonationResource($donation), 'Donasi berhasil diproses', 201);
    }

    /**
     * Menyelesaikan donasi.
     *
     * Mengubah status pembayaran menjadi completed dan menambahkan progress ke kampanye.
     */
    public function complete(\App\Models\Donation $donation, \App\Services\ProgramCampaignService $campaignService): JsonResponse
    {
        if ($donation->payment_status === 'completed') {
            return $this->successResponse(new DonationResource($donation), 'Donasi sudah selesai');
        }

        $donation->update([
            'payment_status' => 'completed',
            'paid_at' => now(),
        ]);

        $campaign = \App\Models\ProgramCampaign::where('program_id', $donation->program_id)->first();
        if ($campaign) {
            $campaignService->recordSuccessfulDonation($campaign, $donation->amount);
        }

        return $this->successResponse(new DonationResource($donation), 'Donasi berhasil diselesaikan');
    }
}