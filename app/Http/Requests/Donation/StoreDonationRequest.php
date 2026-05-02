<?php

namespace App\Http\Requests\Donation;

use Illuminate\Foundation\Http\FormRequest;

class StoreDonationRequest extends FormRequest
{
    public function authorize(): bool
    {

        return true; 
    }

    public function rules(): array
    {
        return [
            'program_id'     => 'required|exists:programs,id',
            'amount'         => 'required|numeric|min:1000',
            'payment_method' => 'required|string',
            'is_anonymous'   => 'boolean',
            'notes'          => 'nullable|string',
            'fee_amount'     => 'nullable|numeric',
        ];
    }
}