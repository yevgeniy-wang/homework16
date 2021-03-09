<?php

namespace Database\Seeders;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(10)->create();

        $ad = Ad::factory(100)->make(['user_id' => null])->each(function ($ad) use ($users) {
            $ad->user_id = $users->random()->id;
            $ad->save();

        });
    }
}
