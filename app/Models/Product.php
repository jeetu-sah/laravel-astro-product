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
    protected $table = 'astro_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'category_id',
        'product_name',
        'slug_name',
        'product_code',
        'price',
        'selling_price',
        'quantity',
        'alert_quantity',
        'availibility',
        'product_status',
        'product_type',
        'short_description',
        'description',
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
