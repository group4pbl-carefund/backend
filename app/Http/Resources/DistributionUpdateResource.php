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
            'title'           => $this->title,
            'content'         => $this->content,
            'image'           => $this->image_url,
            'updated_at'      => $this->created_at->format('d M Y H:i'),
        ];
    }
}