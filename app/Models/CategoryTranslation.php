<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{

    protected $table = 'categories_translations';

    protected $fillable = [
        'category_id',
        'locale',
        'name',
        'short_description',
        'description',
    ];
    public $timestamps = false;
}
