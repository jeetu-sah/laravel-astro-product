<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProductVariant;

class Product extends Model implements TranslatableContract
{
    use Translatable;
    use SoftDeletes;
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
        'product_code',
        'basic_price',
        'product_status',
        'product_type',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $translatedAttributes = [
        'product_name',
        'slug_name',
        'short_description',
        'description',
        'meta_title',
        'meta_keyword',
        'meta_description'
    ];

    protected $translationForeignKey = 'product_id';


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

    public function varients(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }
}
