<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Notification;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(50)
                ->has(Notification::factory()->count(3)->state(function (array $attributes, User $user) {
                    return ['send_to' => serialize([$user->id])];
                }))
                ->create();
    }
}
