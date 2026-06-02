<?php

namespace App\Services;

use App\Models\ProgramCampaign;
use Illuminate\Database\Eloquent\Collection;

class ProgramCampaignService
{
    public function getAllCampaigns(?int $userId = null): Collection
    {
        $query = ProgramCampaign::with(['program', 'program.distribution']);

        if ($userId) {
            $query->whereHas('program', function ($q) use ($userId) {
                $q->where('created_by', $userId);
            });
        }

        return $query->get();
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

    public function recordSuccessfulDonation(ProgramCampaign $campaign, float $amount): ProgramCampaign
    {
        $campaign->increment('current_amount', $amount);
        $campaign->increment('available_balance', $amount);
        $campaign->increment('donor_count', 1);

        $campaign = $campaign->fresh(['program']);
        
        // Auto-complete if target is reached
        if ($campaign->program && $campaign->program->target_amount > 0) {
            if ($campaign->current_amount >= $campaign->program->target_amount) {
                $campaign->program->update(['status' => 'completed']);
                // Note: program_campaigns table may not have 'status', but if it does we would update it here
            }
        }

        return $campaign;
    }

    public function extendCampaign(ProgramCampaign $campaign): ProgramCampaign
    {
        $program = $campaign->program;
        if ($program && $program->end_date) {
            $endDate = new \Carbon\Carbon($program->end_date);
            $program->end_date = $endDate->addDays(7)->toDateString();
            $program->save();
        }
        
        return $campaign->fresh('program');
    }
}