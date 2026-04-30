<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProgramCampaignRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'program_id'        => 'required|exists:programs,program_id',
            'current_amount'    => 'required|numeric|min:0',
            'available_balance' => 'required|numeric|min:0',
            'donor_count'       => 'required|integer|min:0',
        ];
    }
}
