<?php

namespace Database\Seeders;

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
        \App\Models\User::factory()->create([

            'name' => 'Admin Istrator',
            'email' => 'admin@sae-laravel.local',
            'password' => bcrypt('letmein'),
        ]);

        $users = \App\Models\User::factory(10)->create();

        foreach ($users as $user) {

            \App\Models\Posting::factory(10)->create([

                'user_id' => $user->id,
            ]);
        }
    }
}
