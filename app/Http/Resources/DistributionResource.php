<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DistributionResource extends JsonResource
{
    /**
     * Transformasi data model ke dalam bentuk array/JSON.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'program_id'       => $this->program_id,
            'program_name'     => $this->program?->program_name ?? 'Program Tidak Ditemukan',
            'recipient_name'   => $this->recipient_name,
            'amount'           => (int) $this->amount,
            'formatted_amount' => 'Rp ' . number_format($this->amount, 0, ',', '.'),
            'status'           => $this->status,
            'notes'            => $this->notes,
            'evidence_url'     => $this->evidence_url
                ? (\Illuminate\Support\Str::startsWith($this->evidence_url, 'http') ? $this->evidence_url : url($this->evidence_url))
                : null,
            'created_at'       => $this->created_at?->format('d M Y H:i'),
        ];
    }
}