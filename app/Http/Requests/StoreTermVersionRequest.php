<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTermVersionRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'version_number' => 'required|string|unique:term_versions',
            'content' => 'required|string',
            'effective_date' => 'required|date',
        ];
    }
}