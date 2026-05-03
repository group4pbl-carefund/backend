<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentLogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'donation_id' => $this->donation_id,
            'log_details' => $this->log_data,
            'status'      => $this->status,
            'created_at'  => $this->created_at->format('d M Y H:i'),
        ];
    }
}