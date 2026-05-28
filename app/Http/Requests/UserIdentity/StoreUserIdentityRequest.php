<?php
namespace App\Http\Requests\UserIdentity;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserIdentityRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'user_id' => 'required|exists:users,id',
            'identity_type' => 'required|string',
            'identity_number' => 'required|string',
            'identity_image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ];
    }
}