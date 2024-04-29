<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amount = 10;

        $categories = [
            'Smartphones',
            'Laptops',
            'Tablets',
            'Desktops',
            'Monitors',
            'Keyboards',
            'Mice',
            'Headphones',
            'Speakers',
            'Printers',
        ];

        foreach ($categories as $category) {
            CategoryProduct::factory()->create([
                'name' => $category,
                'description' => 'This is a ' . $category . ' category.',
            ]);
        }
    }
}
