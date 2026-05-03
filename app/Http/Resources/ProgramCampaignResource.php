<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgramCampaignResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'campaign_id'       => $this->campaign_id,
            'program_id'        => $this->program_id,
            'current_amount'    => $this->current_amount,
            'available_balance' => $this->available_balance,
            'donor_count'       => $this->donor_count,
            'last_update_date'  => $this->last_update_date,
            'created_at'        => $this->created_at,
        ];
    }
}
