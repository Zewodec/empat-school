<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
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
        $amount = 10;

        $categories = CategoryProduct::inRandomOrder()->get();

        foreach ($categories as $category) {
            $productsAmount = rand(1, 5);

            Product::factory()->count($productsAmount)->create([
                'category_id' => $category->id,
            ]);

        }
    }
}
