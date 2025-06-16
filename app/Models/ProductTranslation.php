<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'product_name',
        'slug_name',
        'short_description',
        'description',
        'meta_title',
        'meta_keyword',
        'meta_description'
    ];
}
