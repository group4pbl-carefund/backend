<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationArticle extends Model
{
    protected $primaryKey = 'article_id';

    protected $fillable = [
        'title',
        'content',
        'category',
        'author_id',
        'thumbnail_url',
        'status',
        'published_at',
        'read_time'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function views()
    {
        return $this->hasMany(EducationView::class, 'article_id', 'article_id');
    }
}
