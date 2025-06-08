<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class AttributeValue extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $fillable = ['attribute_id', 'value', 'sort_order', 'slug'];

    public $translatedAttributes = ['name'];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
