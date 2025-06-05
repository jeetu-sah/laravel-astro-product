<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model implements TranslatableContract
{
    use Translatable;
    use SoftDeletes;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'parent_category_id',
        'slug_name',
        'status',
        'user_id',
        'deleted_at'
    ];

    public $translatedAttributes = ['name', 'short_description', 'description'];

    protected $translationForeignKey = 'category_id';
}
