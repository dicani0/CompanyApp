<?php

namespace Database\Seeders\Administration\Order;

use App\Models\Administration\Order\OrderState;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class OrderStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Collection::make([
            'Preparing',
            'Finished',
            'Canceled'
        ])
            ->each(function ($name) {
                OrderState::factory()->create([
                    'name' => $name
                ]);
            });
    }
}
