<?php

namespace App\Http\Requests\Distribution;

use Illuminate\Foundation\Http\FormRequest;

class StoreDistributionRequest extends FormRequest
{
    /**
     * Izinkan akses untuk semua user yang terautentikasi.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi data distribusi.
     */
    public function rules(): array
    {
        return [
            'program_id'       => 'required|exists:programs,program_id',
            'recipient_name'   => 'required|string|max:255',
            'recipient_location' => 'nullable|string|max:255',
            'amount'           => 'required|numeric|min:0',
            'status'           => 'required|string|max:50',
            'evidence_url'     => 'nullable|url',
            'notes'            => 'nullable|string',
        ];
    }
}