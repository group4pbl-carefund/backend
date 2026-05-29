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
            'user_id'          => $this->user_id,
            'program_id'       => $this->program_id,
            'program_campaign_id' => $this->program_id,
            'program_name'     => $this->program?->program_name ?? 'Program Tidak Ditemukan',
            'donor_name'       => $this->is_anonymous ? 'Hamba Allah' : ($this->user?->full_name ?? 'Anonim'),
            'amount'           => (int) $this->amount,
            'fee_amount'       => (int) ($this->fee_amount ?? 0),
            'total_amount'     => (int) ($this->total_amount ?? $this->amount),
            'formatted_amount' => 'Rp ' . number_format($this->amount, 0, ',', '.'),
            'formatted_fee'    => 'Rp ' . number_format($this->fee_amount ?? 0, 0, ',', '.'),
            'formatted_total'  => 'Rp ' . number_format($this->total_amount ?? $this->amount, 0, ',', '.'),
            'payment_method'   => $this->payment_method,
            'payment_status'   => $this->payment_status,
            'status'           => $this->payment_status,
            'transaction_id'   => $this->transaction_id ?? ('INV-CF-' . date('Ymd', strtotime($this->created_at)) . str_pad($this->id, 4, '0', STR_PAD_LEFT)),
            'created_at'       => $this->created_at,
            'date'             => $this->created_at?->format('d M Y H:i'),
            'program'          => $this->program ? [
                'id'           => $this->program->program_id ?? null,
                'program_name' => $this->program->program_name ?? null,
                'title'        => $this->program->program_name ?? null,
                'image_url'    => $this->program->image_url ? asset($this->program->image_url) : null,
                'category'     => $this->program->category ?? 'Umum',
            ] : null,
        ];
    }
}