<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attribute;
use App\Models\AttributeValue;

class AttributeValueSeeder extends Seeder
{
    public function run(): void
    {
        $values = [
            'color' => [
                ['value' => 'red', 'name' => ['en' => 'Red', 'hi' => 'लाल']],
                ['value' => 'blue', 'name' => ['en' => 'Blue', 'hi' => 'नीला']],
                ['value' => 'green', 'name' => ['en' => 'Green', 'hi' => 'हरा']],
            ],
            'size' => [
                ['value' => 's', 'name' => ['en' => 'Small', 'hi' => 'छोटा']],
                ['value' => 'm', 'name' => ['en' => 'Medium', 'hi' => 'मध्यम']],
                ['value' => 'l', 'name' => ['en' => 'Large', 'hi' => 'बड़ा']],
            ],
            'gender' => [
                ['value' => 'male', 'name' => ['en' => 'Male', 'hi' => 'पुरुष']],
                ['value' => 'female', 'name' => ['en' => 'Female', 'hi' => 'महिला']],
                ['value' => 'unisex', 'name' => ['en' => 'Unisex', 'hi' => 'यूनिसेक्स']],
            ],
            'material' => [
                ['value' => 'cotton', 'name' => ['en' => 'Cotton', 'hi' => 'कॉटन']],
                ['value' => 'polyester', 'name' => ['en' => 'Polyester', 'hi' => 'पॉलिएस्टर']],
            ],
            'pattern' => [
                ['value' => 'plain', 'name' => ['en' => 'Plain', 'hi' => 'सादा']],
                ['value' => 'striped', 'name' => ['en' => 'Striped', 'hi' => 'धारीदार']],
                ['value' => 'printed', 'name' => ['en' => 'Printed', 'hi' => 'प्रिंटेड']],
            ]
        ];

        foreach ($values as $attributeCode => $attributeValues) {
            $attribute = Attribute::where('code', $attributeCode)->first();

            if (!$attribute) {
                echo "Attribute not found: {$attributeCode}\n";
                continue;
            }

            foreach ($attributeValues as $index => $val) {
                $value = AttributeValue::updateOrCreate(
                    [
                        'attribute_id' => $attribute->id,
                        'value' => $val['value'],
                    ],
                    [
                        'sort_order' => $index + 1,
                        'slug' => $val['value'],
                    ]
                );

                foreach ($val['name'] as $locale => $name) {
                    $value->translateOrNew($locale)->name = $name;
                }

                $value->save();
            }
        }
    }
}
