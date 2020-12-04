<?php

namespace Database\Factories\Catering;

use App\Models\Catering\Dish;
use Illuminate\Database\Eloquent\Factories\Factory;

class DishFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dish::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'supplier_id' => rand(1, 3),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(NULL, 3, 30),
            'special_price' => 2
        ];
    }
}
