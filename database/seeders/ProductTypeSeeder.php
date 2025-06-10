<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'Simple',
            'Article',
            'Group',
            'Bundle',
            'Virtual',
            'Configurable',
        ];

        $data = array_map(function ($type) {
            return [
                'name' => $type,
                'slug' => Str::slug($type),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $types);

        DB::table('products_types')->insert($data);
    }
}
