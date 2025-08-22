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
        $groundChakkars = Category::create(['name' => 'Ground Chakkars']);
        $flowerPotts = Category::create(['name' => 'Flower Pots']);

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
            'category_id' => $familyPack->id,
            'name' => '7 Star Pack',
            'package' => 'PACK',
            'price' => 9000,
            'original_price' => 7000,
            'image_path' => 'products/7star.jpg'
        ]);

        Product::create([
            'category_id' => $oneSound->id,
            'name' => '2.75 Kuruvi Crackers',
            'package' => '1 PKT',
            'price' => 7,
            'original_price' => 35,
            'image_path' => 'products/kuruvi.jpeg'
        ]);

        Product::create([
            'category_id' => $oneSound->id,
            'name' => 'Parrot',
            'package' => '1 PKT',
            'price' => 16,
            'original_price' => 80,
            'image_path' => 'products/Parrot.jpg'
        ]);

        Product::create([
            'category_id' => $oneSound->id,
            'name' => '4 Lion Deluxe',
            'package' => '1 PKT',
            'price' => 23,
            'original_price' => 116,
            'image_path' => 'products/LionDLX.jpg'
        ]);

        Product::create([
            'category_id' => $oneSound->id,
            'name' => '6 Fighter Crackers',
            'package' => '1 PKT',
            'price' => 23,
            'original_price' => 116,
            'image_path' => 'products/6Fighter.jpg'
        ]);

        Product::create([
            'category_id' => $groundChakkars->id,
            'name' => 'Ground Chakkar Big (25 Pcs)',
            'package' => '1 BOX',
            'price' => 85,
            'original_price' => 425,
            'image_path' => 'products/chakkarbig1.jpg'
        ]);

        Product::create([
            'category_id' => $groundChakkars->id,
            'name' => 'Ground Chakkar Deluxe',
            'package' => '1 BOX',
            'price' => 120,
            'original_price' => 600,
            'image_path' => 'products/groundchakkarspl.jpg'
        ]);

        Product::create([
            'category_id' => $flowerPotts->id,
            'name' => 'Flower Pots small',
            'package' => '1 BOX',
            'price' => 45,
            'original_price' => 225,
            'image_path' => 'products/flowerpotsmall.jpg'
        ]);

        Product::create([
            'category_id' => $flowerPotts->id,
            'name' => 'Flower Pots Deluxe',
            'package' => '1 BOX',
            'price' => 170,
            'original_price' => 850,
            'image_path' => 'products/flowerpotsdeluxe.jpg'
        ]);
    }
}
