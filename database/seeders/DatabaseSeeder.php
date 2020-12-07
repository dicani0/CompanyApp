<?php

namespace Database\Seeders;

use Database\Seeders\Administration\Order\OrderItemStateSeeder;
use Database\Seeders\Administration\Order\OrderStateSeeder;
use Database\Seeders\Catering\DishSeeder;
use Database\Seeders\Catering\FundingSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\SupplierSeeder;
use Database\Seeders\RoleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            SupplierSeeder::class,
            DishSeeder::class,
            FundingSeeder::class,
            OrderStateSeeder::class,
            OrderItemStateSeeder::class,
        ]);
    }
}
