<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);
        if (!empty($data['thumbnail_url']) && !str_starts_with($data['thumbnail_url'], 'http')) {
            $data['thumbnail_url'] = asset($data['thumbnail_url']);
        }
        return $data;
    }
}
