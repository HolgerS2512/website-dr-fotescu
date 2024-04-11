<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            AdminSeeder::class,
            PageSeeder::class,
            SubpageSeeder::class,
            ImageSeeder::class,
            PublicSeeder::class,
            WordSeeder::class,
            ContentSeeder::class,
            DeContentSeeder::class,
            DeListSeeder::class,
            InfoSeeder::class,
            OpeningHoursSeeder::class,
        ]);
    }
}
