<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ProductVariantValue;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class ProductVariant extends Model
{
    use HasFactory;

    protected $table  = 'product_variants';

    protected $fillable = [
        'product_id',
        'sku',
        'price',
        'stock',
        'product_variants_status',
    ];

    /**
     * A variant belongs to a product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * A variant belongs to a product.
     */
    public function varientAttributes(): HasMany
    {
        return $this->hasMany(ProductVariantValue::class, 'product_variant_id');
    }


    public function images(): BelongsToMany
    {
        return $this->belongsToMany(ImageGallery::class, 'product_images', 'product_variant_id', 'image_id')->withPivot('id');
    }
}
