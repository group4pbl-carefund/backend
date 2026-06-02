<?php

namespace App\Http\Requests\Program;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgramRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'program_name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'target_amount' => 'sometimes|numeric|min:0',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_date',
            'status' => 'sometimes|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'image_url' => 'nullable|string',
            'created_by' => 'sometimes|exists:users,id',
            'admin_feedback' => 'nullable|string',
            'beneficiary_type' => 'nullable|string',
            'documents' => 'nullable|array',
            'ktp_file' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'selfie_file' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'supporting_docs' => 'nullable|array',
            'supporting_docs.*' => 'file|mimes:jpeg,png,jpg,pdf|max:10240',
        ];
    }
}