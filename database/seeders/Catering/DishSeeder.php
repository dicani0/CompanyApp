<?php

namespace Database\Seeders\Catering;

use App\Models\Catering\Dish;
use Illuminate\Database\Seeder;



class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dish::factory()->times(50)->create();
    }
}
