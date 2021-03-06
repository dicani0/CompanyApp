<?php

namespace Database\Seeders;

use Database\Seeders\Administration\Order\OrderItemStateSeeder;
use Database\Seeders\Administration\Order\OrderStateSeeder;
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
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            SupplierSeeder::class,
            OrderStateSeeder::class,
            OrderItemStateSeeder::class,
        ]);
    }
}
