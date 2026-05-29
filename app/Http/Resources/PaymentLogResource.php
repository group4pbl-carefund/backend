<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentLogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'donation_id'    => $this->donation_id,
            'transaction_id' => $this->transaction_id,
            'payment_type'   => $this->payment_type,
            'raw_response'   => $this->raw_response,
            'created_at'     => $this->created_at ? $this->created_at->format('d M Y H:i') : null,
            'donation'       => $this->relationLoaded('donation') && $this->donation ? [
                'id'             => $this->donation->id,
                'amount'         => $this->donation->amount,
                'fee_amount'     => $this->donation->fee_amount,
                'total_amount'   => $this->donation->total_amount,
                'payment_method' => $this->donation->payment_method,
                'payment_status' => $this->donation->payment_status,
                'user'           => $this->donation->user ? [
                    'id'        => $this->donation->user->id,
                    'full_name' => $this->donation->user->full_name,
                    'email'     => $this->donation->user->email,
                ] : null,
                'program'        => $this->donation->program ? [
                    'id'           => $this->donation->program->program_id,
                    'program_name' => $this->donation->program->program_name,
                ] : null,
            ] : null,
        ];
    }
}