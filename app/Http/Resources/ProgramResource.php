<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ProgramResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'program_id' => $this->program_id,

            'program_name' => $this->program_name,
            'category' => $this->category,
            'description' => $this->description,
            'target_amount' => $this->target_amount,
            'current_amount' => $this->whenLoaded('campaign', function () {
                return $this->campaign->current_amount;
            }, 0),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
            'admin_feedback' => $this->admin_feedback,
            'image_url' => $this->image_url ? (\Illuminate\Support\Str::startsWith($this->image_url, 'http') ? $this->image_url : url($this->image_url)) : null,
            'recipient_name' => $this->recipient_name,
            'beneficiary_type' => $this->beneficiary_type,
            'documents' => $this->documents,
            'bank_name' => $this->bank_name,
            'account_number' => $this->account_number,
            'account_owner' => $this->account_owner,
            'rab_items' => $this->rab_items,
            'created_by' => $this->created_by,
            'user' => $this->whenLoaded('user', function () {
                return [
                    'id' => $this->user->id,
                    'full_name' => $this->user->full_name,
                    'created_at' => $this->user->created_at,
                ];
            }),
            'distribution' => $this->whenLoaded('distribution', function () {
                return $this->distribution ? new DistributionResource($this->distribution) : null;
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}