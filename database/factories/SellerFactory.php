<?php

namespace Database\Factories;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Seller>
 */
class SellerFactory extends Factory
{
    protected $model = Seller::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'role' => $this->faker->jobTitle(),
            'avatar' => $this->faker->imageUrl(200, 200, 'people'),
            'about' => $this->faker->paragraph(2),
        ];
    }
}
