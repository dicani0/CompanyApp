<?php

namespace Database\Seeders;

use App\Models\Administration\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->create([
                'name' => 'Dawid',
                'email' => 'test@test.test',
                'password' => Hash::make('123'),
                'verified' => 1,

            ])
            ->roles()
            ->attach(Role::find(1));


        User::factory()
            ->create([
                'name' => 'Dostawca',
                'email' => 'dostawca@test.test',
                'password' => Hash::make('123'),
                'verified' => 1,
            ])
            ->roles()
            ->attach(Role::find(2));
    }
}
