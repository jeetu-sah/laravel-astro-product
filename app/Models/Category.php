<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


class Category extends Model implements TranslatableContract
{
    use Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'parent_category_id',
        'slug_name',
        'status',
        'user_id'
    ];

    public $translatedAttributes = ['name', 'short_description', 'description'];

    protected $translationForeignKey = 'category_id';
}
