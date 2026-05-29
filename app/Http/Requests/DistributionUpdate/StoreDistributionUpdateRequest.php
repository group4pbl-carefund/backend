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
            'status'          => 'required|string|max:50',
            'notes'           => 'nullable|string',
            'proof_url'       => 'nullable|url',
            'updated_by'      => 'nullable|exists:users,id',
        ];
    }
}