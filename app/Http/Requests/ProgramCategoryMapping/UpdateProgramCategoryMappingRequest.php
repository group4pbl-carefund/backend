<?php

namespace App\Http\Requests\ProgramCategoryMapping;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgramCategoryMappingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'program_id' => 'sometimes|exists:programs,program_id',
            'category_id' => 'sometimes|exists:program_categories,category_id',
        ];
    }
}