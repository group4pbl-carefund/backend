<?php
namespace App\Http\Requests\UserIdentity;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserIdentityRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'is_verified' => 'boolean',
            'verified_at' => 'date|nullable',
            'verified_by' => 'exists:users,id|nullable',
            'identity_number' => 'sometimes|string',
        ];
    }
}