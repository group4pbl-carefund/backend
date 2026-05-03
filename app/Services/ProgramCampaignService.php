<?php

namespace App\Services;

use App\Models\ProgramCampaign;
use Illuminate\Database\Eloquent\Collection;

class ProgramCampaignService
{
    public function getAllCampaigns(): Collection
    {
        // Menggunakan eager loading agar performa database lebih ringan
        return ProgramCampaign::with('program')->get();
    }

    public function createCampaign(array $data): ProgramCampaign
    {
        // Set nilai default jika data tidak dikirim
        $data['current_amount'] = $data['current_amount'] ?? 0;
        $data['available_balance'] = $data['available_balance'] ?? 0;
        $data['donor_count'] = $data['donor_count'] ?? 0;

        return ProgramCampaign::create($data);
    }

    public function updateCampaign(ProgramCampaign $campaign, array $data): ProgramCampaign
    {
        $campaign->update($data);
        return $campaign;
    }

    public function deleteCampaign(ProgramCampaign $campaign): bool
    {
        return $campaign->delete();
    }

    // Fungsi tambahan untuk mencatat donasi masuk
    public function recordSuccessfulDonation(ProgramCampaign $campaign, float $amount): ProgramCampaign
    {
        $campaign->increment('current_amount', $amount);
        $campaign->increment('available_balance', $amount);
        $campaign->increment('donor_count', 1);

        return $campaign->fresh();
    }
}