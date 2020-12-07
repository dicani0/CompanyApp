<?php

namespace Database\Seeders\Catering;

use App\Models\Catering\Funding;
use App\Models\User;
use Illuminate\Database\Seeder;

class FundingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $users->each(function (User $user) {
            Funding::factory()->create(['user_id' => $user->id]);
        });
    }
}
