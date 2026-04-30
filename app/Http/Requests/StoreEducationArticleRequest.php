<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEducationArticleRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string',
            'author_id' => 'required|exists:users,id',
            'status' => 'required|string',
            'published_at' => 'date|nullable',
        ];
    }
}