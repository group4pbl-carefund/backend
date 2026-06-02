<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgramCategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'category_id' => $this->category_id,
            'category_name' => $this->category_name,
            'description' => $this->description,
            'icon_url' => $this->icon_url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}