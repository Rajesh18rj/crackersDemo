<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $familyPack = Category::create(['name' => 'Family Pack']);
        $oneSound  = Category::create(['name' => 'One Sound Crackers']);

        Product::create([
            'category_id' => $familyPack->id,
            'name' => '3 Star Pack',
            'package' => 'PACK',
            'price' => 2000,
            'original_price' => 3000,
            'image_path' => 'products/3star.jpeg'
        ]);

        Product::create([
            'category_id' => $familyPack->id,
            'name' => '5 Star Pack',
            'package' => 'PACK',
            'price' => 4000,
            'original_price' => 5500,
            'image_path' => 'products/5star.jpg'
        ]);

        Product::create([
            'category_id' => $oneSound->id,
            'name' => '2.75 Kuruvi Crackers',
            'package' => '1 PKT',
            'price' => 7,
            'original_price' => 35,
            'image_path' => 'products/kuruvi.jpeg'
        ]);
    }
}
