<?php

namespace Database\Seeders;

use App\Models\Catering\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::factory()
            ->times(20)
            ->create();
    }
}
