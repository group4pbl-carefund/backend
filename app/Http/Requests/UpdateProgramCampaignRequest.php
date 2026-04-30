<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgramCampaignRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'program_id'        => 'sometimes|required|exists:programs,program_id',
            'current_amount'    => 'sometimes|required|numeric|min:0',
            'available_balance' => 'sometimes|required|numeric|min:0',
            'donor_count'       => 'sometimes|required|integer|min:0',
        ];
    }
}
