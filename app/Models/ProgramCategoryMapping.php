<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramCategoryMapping extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'program_id',
        'category_id'
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function category()
    {
        return $this->belongsTo(ProgramCategory::class, 'category_id');
    }
}
