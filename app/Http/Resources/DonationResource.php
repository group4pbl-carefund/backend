<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DonationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'program_name'     => $this->program->name ?? 'Program Tidak Ditemukan',
            'donor_name'       => $this->is_anonymous ? 'Hamba Allah' : ($this->user->name ?? 'Anonim'),
            'amount'           => (int) $this->amount,
            'formatted_amount' => 'Rp ' . number_format($this->amount, 0, ',', '.'),
            'payment_method'   => $this->payment_method,
            'status'           => $this->payment_status,
            'date'             => $this->created_at->format('d M Y H:i'),
        ];
    }
}