<?php
namespace App\Http\Requests\EducationArticle;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEducationArticleRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'title' => 'string|max:255',
            'content' => 'string',
            'category' => 'string',
            'status' => 'string',
            'published_at' => 'date|nullable',
        ];
    }
}