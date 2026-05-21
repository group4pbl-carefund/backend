<?php
namespace App\Http\Requests\EducationArticle;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEducationArticleRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'title' => 'string|max:255|nullable',
            'content' => 'string|nullable',
            'category' => 'string|nullable',
            'status' => 'string|nullable',
            'published_at' => 'date|nullable',
        ];
    }
}