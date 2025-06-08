<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Product extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'category_id',
        'slug_name',
        'product_code',
        'basic_price',
        'product_type',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function images(): BelongsToMany
    {
        return $this->belongsToMany(ImageGallery::class, 'product_images', 'product_id', 'image_id')->withPivot('id');
    }

    public function productFirstImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->images->first()?->image_url ?? '',
        );
    }

    public function productFirstImagePath(): Attribute
    {
        return Attribute::make(
            get: fn() => ($this->productFirstImageUrl) ? asset('storage/app/private/' . $this->productFirstImageUrl) : null,
        );
    }
}
