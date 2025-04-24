<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
