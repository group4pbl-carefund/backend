<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DistributionUpdateResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'distribution_id' => $this->distribution_id,
            'status'          => $this->status,
            'notes'           => $this->notes,
            'proof_url'       => $this->proof_url,
            'created_at'      => $this->created_at?->format('d M Y H:i'),
        ];
    }
}