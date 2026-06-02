<?php

namespace App\Http\Requests\PaymentLog;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'donation_id'    => 'required|exists:donations,id',
            'transaction_id' => 'nullable|string',
            'payment_type'   => 'nullable|string',
            'raw_response'   => 'nullable|array',
        ];
    }
}