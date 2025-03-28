<?php

namespace Database\Seeders;

use App\Models\Bedroom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BedroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bedroom::insert([
            [
                'category_bedrooms_id' => 1,
                'code_bedroom' => 'BDRM001',
                'main_image_url' => 'http',
                'is_available' => false,
                'title_bedroom' => 'Bedroom 1',
                'description' => 'ini Bedroom 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_bedrooms_id' => 2,
                'code_bedroom' => 'BDRM002',
                'main_image_url' => 'http',
                'is_available' => false,
                'title_bedroom' => 'Bedroom 2',
                'description' => 'ini Bedroom 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_bedrooms_id' => 3,
                'code_bedroom' => 'BDRM003',
                'main_image_url' => 'http',
                'is_available' => false,
                'title_bedroom' => 'Bedroom 3',
                'description' => 'ini Bedroom 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
