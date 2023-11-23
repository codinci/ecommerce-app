<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::truncate();

        $sizes = ['small', 'medium', 'large'];
        $images = ['1700686781.jpg', '1700722281.jpg'];

        for ($i = 1; $i <= 20; $i++) {
            Product::create([
                'name' => "Clothing $i",
                'original_price' => rand(800, 5000),
                'promotional_price' => rand(650, 4500),
                'saving' => rand(5, 25),
                'size' => $sizes[array_rand($sizes)],
                'image_filename' => $images[array_rand($images)],
            ]);
        }
    }
}
