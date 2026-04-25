<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramCategory extends Model
{
    protected $primaryKey = 'category_id';

    protected $fillable = [
        'category_name',
        'description',
        'icon_url',

    ];
}
