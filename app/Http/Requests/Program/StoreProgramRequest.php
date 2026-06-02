<?php

namespace App\Http\Requests\Program;

use Illuminate\Foundation\Http\FormRequest;

class StoreProgramRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_verified;
    }

    public function rules(): array
    {
        return [
            'program_name' => 'required|string|max:255',
            'description' => 'required|string',
            'target_amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'image_url' => 'nullable|string',
            'created_by' => 'required|exists:users,id',
            'category' => 'nullable|string|max:100',
            'recipient_name' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:100',
            'account_number' => 'nullable|string|max:50',
            'account_owner' => 'nullable|string|max:255',
            'rab_items' => 'nullable|array',
            'beneficiary_type' => 'nullable|string',
            'documents' => 'nullable|array',
            'ktp_file' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'selfie_file' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'supporting_docs' => 'nullable|array',
            'supporting_docs.*' => 'file|mimes:jpeg,png,jpg,pdf|max:10240',
            'admin_feedback' => 'nullable|string',
        ];
    }
}