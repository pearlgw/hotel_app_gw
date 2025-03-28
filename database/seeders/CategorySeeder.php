<?php

namespace Database\Seeders;

use App\Models\CategoryBedroom;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryBedroom::insert([
            [
                'code_category_bedroom' => 'BDRM001',
                'category_name' => 'Standard Room',
                'price' => 300000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code_category_bedroom' => 'BDRM002',
                'category_name' => 'Deluxe Room',
                'price' => 500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code_category_bedroom' => 'BDRM003',
                'category_name' => 'Suite Room',
                'price' => 750000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
