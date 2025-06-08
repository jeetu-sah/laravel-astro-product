<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariantValue extends Model
{
    use HasFactory;

    protected $table  = 'product_variant_values';

    protected $fillable = [
        'product_variant_id',
        'attribute_id',
        'attribute_value_id',
        'created_at',
        'updated_at',
    ];
}
