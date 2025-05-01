<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ImageGallery extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'image_galleries';


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'image_name',
        'alt_name',
        'name',
        'image_url',
        'image_size',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
