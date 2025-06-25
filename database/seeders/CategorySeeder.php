<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'parent_category_id' => null,
                'slug_name' => 'electronics',
                'status' => 'active',
                'user_id' => 1,
                'translations' => [
                    'en' => [
                        'name' => 'Electronics',
                        'short_description' => 'Electronic devices',
                        'description' => 'All kinds of electronic gadgets and devices.'
                    ],
                    'hi' => [
                        'name' => 'इलेक्ट्रॉनिक्स',
                        'short_description' => 'इलेक्ट्रॉनिक डिवाइस',
                        'description' => 'सभी प्रकार के इलेक्ट्रॉनिक गैजेट्स और डिवाइस।'
                    ]
                ]
            ],
            [
                'parent_category_id' => null,
                'slug_name' => 'books',
                'status' => 'active',
                'user_id' => 1,
                'translations' => [
                    'en' => [
                        'name' => 'Books',
                        'short_description' => 'Various kinds of books',
                        'description' => 'Books on various subjects and genres.'
                    ],
                    'hi' => [
                        'name' => 'पुस्तकें',
                        'short_description' => 'विभिन्न प्रकार की पुस्तकें',
                        'description' => 'विभिन्न विषयों और विधाओं पर पुस्तकें।'
                    ]
                ]
            ],
            [
                'parent_category_id' => null,
                'slug_name' => 'clothing',
                'status' => 'active',
                'user_id' => 1,
                'translations' => [
                    'en' => [
                        'name' => 'Clothing',
                        'short_description' => 'Fashion and apparel',
                        'description' => 'Men’s, women’s and kids’ clothing and accessories.'
                    ],
                    'hi' => [
                        'name' => 'कपड़े',
                        'short_description' => 'फैशन और परिधान',
                        'description' => 'पुरुषों, महिलाओं और बच्चों के कपड़े और एक्सेसरीज़।'
                    ]
                ]
            ],
            [
                'parent_category_id' => null,
                'slug_name' => 'home-appliances',
                'status' => 'active',
                'user_id' => 1,
                'translations' => [
                    'en' => [
                        'name' => 'Home Appliances',
                        'short_description' => 'Appliances for home use',
                        'description' => 'Refrigerators, washing machines, and more.'
                    ],
                    'hi' => [
                        'name' => 'घरेलू उपकरण',
                        'short_description' => 'घर के उपयोग के उपकरण',
                        'description' => 'फ्रिज, वॉशिंग मशीन और अन्य उपकरण।'
                    ]
                ]
            ],
            [
                'parent_category_id' => null,
                'slug_name' => 'furniture',
                'status' => 'active',
                'user_id' => 1,
                'translations' => [
                    'en' => [
                        'name' => 'Furniture',
                        'short_description' => 'Home and office furniture',
                        'description' => 'Sofas, tables, beds, and office chairs.'
                    ],
                    'hi' => [
                        'name' => 'फर्नीचर',
                        'short_description' => 'घर और ऑफिस के फर्नीचर',
                        'description' => 'सोफा, टेबल, बेड और ऑफिस की कुर्सियाँ।'
                    ]
                ]
            ],
            [
                'parent_category_id' => null,
                'slug_name' => 'toys-games',
                'status' => 'active',
                'user_id' => 1,
                'translations' => [
                    'en' => [
                        'name' => 'Toys & Games',
                        'short_description' => 'Fun for all ages',
                        'description' => 'Educational and fun toys and games for kids and adults.'
                    ],
                    'hi' => [
                        'name' => 'खिलौने और खेल',
                        'short_description' => 'हर उम्र के लिए मनोरंजन',
                        'description' => 'बच्चों और बड़ों के लिए शैक्षिक और मज़ेदार खिलौने और खेल।'
                    ]
                ]
            ],
            [
                'parent_category_id' => null,
                'slug_name' => 'beauty-personal-care',
                'status' => 'active',
                'user_id' => 1,
                'translations' => [
                    'en' => [
                        'name' => 'Beauty & Personal Care',
                        'short_description' => 'Health and grooming essentials',
                        'description' => 'Skincare, haircare, and wellness products.'
                    ],
                    'hi' => [
                        'name' => 'सौंदर्य और व्यक्तिगत देखभाल',
                        'short_description' => 'स्वास्थ्य और सौंदर्य उत्पाद',
                        'description' => 'त्वचा, बाल और व्यक्तिगत देखभाल के उत्पाद।'
                    ]
                ]
            ],
            [
                'parent_category_id' => null,
                'slug_name' => 'sports-fitness',
                'status' => 'active',
                'user_id' => 1,
                'translations' => [
                    'en' => [
                        'name' => 'Sports & Fitness',
                        'short_description' => 'Gear for fitness and sports',
                        'description' => 'Equipment and accessories for an active lifestyle.'
                    ],
                    'hi' => [
                        'name' => 'खेल और फिटनेस',
                        'short_description' => 'फिटनेस और खेल के लिए सामान',
                        'description' => 'एक सक्रिय जीवनशैली के लिए उपकरण और सहायक उपकरण।'
                    ]
                ]
            ]
        ];



        foreach ($categories as $data) {
            $translations = $data['translations'];
            unset($data['translations']);

            // You can use 'slug_name' as a unique key here
            $category = Category::updateOrCreate(
                ['slug_name' => $data['slug_name']],
                $data
            );

            foreach ($translations as $locale => $fields) {
                $category->translateOrNew($locale)->fill($fields);
            }

            $category->save();
        }


        $clothingId = \App\Models\Category::where('slug_name', 'clothing')->first()->id;

        $categories[] = [
            'parent_category_id' => $clothingId,
            'slug_name' => 'mens-clothing',
            'status' => 'active',
            'user_id' => 1,
            'translations' => [
                'en' => [
                    'name' => "Men's Clothing",
                    'short_description' => 'Shirts, pants, ethnic wear, and more',
                    'description' => 'Wide range of clothing options for men including formal, casual and traditional outfits.'
                ],
                'hi' => [
                    'name' => 'पुरुषों के कपड़े',
                    'short_description' => 'शर्ट, पैंट, पारंपरिक परिधान आदि',
                    'description' => 'पुरुषों के लिए औपचारिक, कैजुअल और पारंपरिक कपड़ों की विस्तृत श्रृंखला।'
                ]
            ]
        ];

        $categories[] = [
            'parent_category_id' => $clothingId,
            'slug_name' => 'womens-clothing',
            'status' => 'active',
            'user_id' => 1,
            'translations' => [
                'en' => [
                    'name' => "Women's Clothing",
                    'short_description' => 'Sarees, dresses, kurtis, tops and more',
                    'description' => 'Trendy and traditional clothing for women for every occasion.'
                ],
                'hi' => [
                    'name' => 'महिलाओं के कपड़े',
                    'short_description' => 'साड़ी, कुर्ती, टॉप और अधिक',
                    'description' => 'हर अवसर के लिए महिलाओं के लिए फैशनेबल और पारंपरिक परिधान।'
                ]
            ]
        ];

        $categories[] = [
            'parent_category_id' => $clothingId,
            'slug_name' => 'kids-clothing',
            'status' => 'active',
            'user_id' => 1,
            'translations' => [
                'en' => [
                    'name' => "Kids' Clothing",
                    'short_description' => 'Clothing for boys and girls',
                    'description' => 'Comfortable and fun clothing for kids of all ages.'
                ],
                'hi' => [
                    'name' => 'बच्चों के कपड़े',
                    'short_description' => 'लड़कों और लड़कियों के कपड़े',
                    'description' => 'हर उम्र के बच्चों के लिए आरामदायक और मजेदार कपड़े।'
                ]
            ]
        ];

        $categories[] = [
            'parent_category_id' => $clothingId,
            'slug_name' => 'winter-wear',
            'status' => 'active',
            'user_id' => 1,
            'translations' => [
                'en' => [
                    'name' => 'Winter Wear',
                    'short_description' => 'Jackets, sweaters, thermals, coats',
                    'description' => 'Keep warm with high-quality winter clothing for men, women, and kids.'
                ],
                'hi' => [
                    'name' => 'शीतकालीन वस्त्र',
                    'short_description' => 'जैकेट, स्वेटर, थर्मल, कोट',
                    'description' => 'पुरुषों, महिलाओं और बच्चों के लिए उच्च गुणवत्ता वाले सर्दी के कपड़े।'
                ]
            ]
        ];

        $categories[] = [
            'parent_category_id' => $clothingId,
            'slug_name' => 'ethnic-wear',
            'status' => 'active',
            'user_id' => 1,
            'translations' => [
                'en' => [
                    'name' => 'Ethnic Wear',
                    'short_description' => 'Traditional Indian attire',
                    'description' => 'Kurtas, sarees, lehengas, and other Indian ethnic wear.'
                ],
                'hi' => [
                    'name' => 'पारंपरिक वस्त्र',
                    'short_description' => 'पारंपरिक भारतीय पोशाक',
                    'description' => 'कुर्ता, साड़ी, लहंगा और अन्य पारंपरिक कपड़े।'
                ]
            ]
        ];


        foreach ($categories as $data) {
            $translations = $data['translations'];
            unset($data['translations']);

            // You can use 'slug_name' as a unique key here
            $category = Category::updateOrCreate(
                ['slug_name' => $data['slug_name']],
                $data
            );

            foreach ($translations as $locale => $fields) {
                $category->translateOrNew($locale)->fill($fields);
            }

            $category->save();
        }
    }
}
