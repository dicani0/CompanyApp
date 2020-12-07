<?php

namespace Database\Factories\Catering;

use App\Models\Catering\Funding;
use Illuminate\Database\Eloquent\Factories\Factory;

class FundingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Funding::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'default_amount' => 500,
            'amount' => 500
        ];
    }
}
