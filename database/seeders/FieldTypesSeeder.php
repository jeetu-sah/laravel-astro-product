<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FieldTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('field_types')->insert([
            ['code' => 'text', 'label' => 'Text'],
            ['code' => 'textarea', 'label' => 'Textarea'],
            ['code' => 'select', 'label' => 'Dropdown'],
            ['code' => 'multiselect', 'label' => 'Multi Select'],
            ['code' => 'image', 'label' => 'Image Upload'],
            ['code' => 'checkbox', 'label' => 'Checkbox'],
            ['code' => 'radio', 'label' => 'Radio Buttons'],
            ['code' => 'number', 'label' => 'Number'],
            ['code' => 'boolean', 'label' => 'Yes/No'],
        ]);
    }
}
