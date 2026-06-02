<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationView extends Model
{
    protected $primaryKey = 'view_id';

    protected $fillable = [
        'article_id',
        'user_id',
        'viewed_at'
    ];

    public function article()
    {
        return $this->belongsTo(EducationArticle::class, 'article_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
