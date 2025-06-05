<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Attribute extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $fillable = [
        'code', 'type', 'is_filterable', 'is_required'
    ];

    public $translatedAttributes = ['name'];

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
} 
