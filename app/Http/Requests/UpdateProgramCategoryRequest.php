<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgramCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_name' => 'sometimes|string|max:255',
            'description' => 'sometimes|nullable|string',
            'icon_url' => 'sometimes|nullable|string',
        ];
    }
}