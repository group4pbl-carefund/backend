<?php

namespace App\Http\Requests\DistributionUpdate;

use Illuminate\Foundation\Http\FormRequest;

class StoreDistributionUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'distribution_id' => 'required|exists:distributions,id',
            'title'           => 'required|string|max:255',
            'content'         => 'required|string',
            'image_url'       => 'nullable|url',
        ];
    }
}