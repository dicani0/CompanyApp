<?php

namespace Database\Seeders;

use App\Models\Administration\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::factory()
            ->create([
                'name' => 'admin',
            ]);

        Role::factory()
            ->create([
                'name' => 'worker'
            ]);

        Role::factory()
            ->create([
                'name' => 'supplier'
            ]);
    }
}
