<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // computer, phone, tablet, etc
        $product_name = [
            'computer',
            'phone',
            'tablet',
            'laptop',
            'smartwatch',
            'smartglasses',
            'smartphone',
            'smartTV',
            'smartfridge',
            'smartdoor',
            'smartlock',
            'smartcar',
            'smartbike',
            'smartmotorcycle',
            'smartbus',
            'smarttrain',
            'smartplane',
            'smartboat',
            'smartship',
            'smartsubmarine',
            'smartspaceship',
            'smartrocket',
            'smartmoon',
            'smartmars',
            'smartjupiter',
            'smartsaturn',
            'smarturanus',
            'smartneptune',
            'smartpluto',
            'smartstar',
            'smartgalaxy',
            'smartuniverse',
            'smartmultiverse',
            'smartmetaverse',
            'smartmegaverse',
            'smarthyperverse',
            'smartultraverse',
            'smartomniverse',
        ];

        return [
            'name' => $this->faker->randomElement($product_name),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'description' => $this->faker->text,
        ];
    }
}
