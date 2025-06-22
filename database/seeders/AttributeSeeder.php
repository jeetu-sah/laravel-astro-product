<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    public function run()
    {
        $attributes = [
            [
                'code' => 'color',
                'type' => 'select',
                'is_filterable' => true,
                'is_required' => true,
                'status' => 'active',
                'translations' => [
                    'en' => [
                        'name' => 'Color',
                        'description' => 'Color of the product',
                        'slug_name' => 'color',
                    ],
                    'hi' => [
                        'name' => 'रंग',
                        'description' => 'उत्पाद का रंग',
                        'slug_name' => 'rang',
                    ],
                ]
            ],
            [
                'code' => 'size',
                'type' => 'select',
                'is_filterable' => true,
                'is_required' => false,
                'status' => 'active',
                'translations' => [
                    'en' => [
                        'name' => 'Size',
                        'description' => 'Size of the product',
                        'slug_name' => 'size',
                    ],
                    'hi' => [
                        'name' => 'आकार',
                        'description' => 'उत्पाद का आकार',
                        'slug_name' => 'aakaar',
                    ],
                ]
            ],
            [
                'code' => 'material',
                'type' => 'text',
                'is_filterable' => true,
                'is_required' => false,
                'status' => 'active',
                'translations' => [
                    'en' => [
                        'name' => 'Material',
                        'description' => 'Material used in the product',
                        'slug_name' => 'material',
                    ],
                    'hi' => [
                        'name' => 'सामग्री',
                        'description' => 'उत्पाद में प्रयुक्त सामग्री',
                        'slug_name' => 'saamagri',
                    ],
                ]
            ],
            [
                'code' => 'brand',
                'type' => 'text',
                'is_filterable' => true,
                'is_required' => false,
                'status' => 'active',
                'translations' => [
                    'en' => [
                        'name' => 'Brand',
                        'description' => 'Brand of the product',
                        'slug_name' => 'brand',
                    ],
                    'hi' => [
                        'name' => 'ब्रांड',
                        'description' => 'उत्पाद का ब्रांड',
                        'slug_name' => 'brand',
                    ],
                ]
            ],
            [
                'code' => 'warranty',
                'type' => 'text',
                'is_filterable' => false,
                'is_required' => false,
                'status' => 'active',
                'translations' => [
                    'en' => [
                        'name' => 'Warranty',
                        'description' => 'Warranty period of the product',
                        'slug_name' => 'warranty',
                    ],
                    'hi' => [
                        'name' => 'वारंटी',
                        'description' => 'उत्पाद की वारंटी अवधि',
                        'slug_name' => 'warranty',
                    ],
                ]
            ],
            [
                'code' => 'gender',
                'type' => 'select',
                'is_filterable' => true,
                'is_required' => false,
                'status' => 'active',
                'translations' => [
                    'en' => [
                        'name' => 'Gender',
                        'description' => 'Target gender for the product',
                        'slug_name' => 'gender',
                    ],
                    'hi' => [
                        'name' => 'लिंग',
                        'description' => 'उत्पाद के लिए लक्षित लिंग',
                        'slug_name' => 'ling',
                    ],
                ]
            ],
            [
                'code' => 'fabric',
                'type' => 'text',
                'is_filterable' => true,
                'is_required' => false,
                'status' => 'active',
                'translations' => [
                    'en' => ['name' => 'Fabric', 'description' => 'Fabric type', 'slug_name' => 'fabric'],
                    'hi' => ['name' => 'कपड़ा', 'description' => 'कपड़े का प्रकार', 'slug_name' => 'kapda'],
                ]
            ],
            [
                'code' => 'pattern',
                'type' => 'text',
                'is_filterable' => false,
                'is_required' => false,
                'status' => 'active',
                'translations' => [
                    'en' => ['name' => 'Pattern', 'description' => 'Product pattern or style', 'slug_name' => 'pattern'],
                    'hi' => ['name' => 'पैटर्न', 'description' => 'डिज़ाइन या पैटर्न', 'slug_name' => 'pattern'],
                ]
            ],
        ];


        foreach ($attributes as $data) {
            $translations = $data['translations'];
            unset($data['translations']);

            // Use updateOrCreate to avoid duplicates
            $attribute = \App\Models\Attribute::updateOrCreate(
                ['code' => $data['code']],  // Match by code
                $data                       // Update or insert this data
            );

            // Update translations
            foreach ($translations as $locale => $translation) {
                $attribute->translateOrNew($locale)->fill($translation);
            }

            $attribute->save();
        }
    }
}
