<?php
namespace App\Http\Requests\TermVersion;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTermVersionRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'version_number' => 'string',
            'content' => 'string',
            'effective_date' => 'date',
        ];
    }
}