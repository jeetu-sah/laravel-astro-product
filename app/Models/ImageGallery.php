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

    const UPLOAD_PRODUCT_VARIENT = 'product_variants';
    const UPLOAD_PRODUCT = 'product';


    public static function mapdetails($imageFor, $id)
    {
        switch ($imageFor) {
            case 'product':
                // logic for product
                return [
                    'id' => $id,
                    'imageFor' => 'App\Models\Product',
                    'model' => 'App\Models\Product',
                    'upload_route' => route('catalog.product-varient.upload-image', ['id' => $id]),
                ];
                break;

            case 'product_variants':
                // logic for category
                
                return [
                    'id' => $id,
                    'imageFor' => 'App\Models\ProductVariant',
                    'model' => 'App\Models\ProductVariant',
                    'upload_route' => route('image-gallery.product-varient.upload-image', ['id' => $id]),
                ];
                break;

            case 'brand':
                // logic for brand
                echo "Image is for a brand. ID: $id";
                break;

            default:
                echo "Unknown imageFor type: $imageFor. ID: $id";
                break;
        }
    }
}
