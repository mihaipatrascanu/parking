<?php

namespace Database\Seeders;
use Database\Seeders\ParkingSeeder;
use Database\Seeders\SpotSeeder;
use Database\Seeders\PriceSeeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        $this->call(ParkingSeeder::class);
        $this->call(SpotSeeder::class);
        $this->call(PriceSeeder::class);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
