<?php

namespace Database\Seeders\Administration\Order;

use App\Models\Administration\Order\OrderItemState;
use Illuminate\Database\Seeder;

class OrderItemStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderItemState::factory()->create(
            [
                'name' => 'Delivered'
            ]
        );
        OrderItemState::factory()->create(
            [
                'name' => 'Preparing'
            ]
        );
        OrderItemState::factory()->create(
            [
                'name' => 'Canceled'
            ]
        );
    }
}
