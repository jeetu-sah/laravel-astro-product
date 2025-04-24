<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'parent_category_id',
        'slug_name',
        'name',
        'short_description',
        'description',
        'status',
        'user_id'
    ];
}
