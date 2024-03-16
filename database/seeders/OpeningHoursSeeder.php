<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OpeningHoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $opening = DB::table('opening_hours');

        $opening->insert([
            'ranking' => 1,
            'day' => 'monday',
            'open' => '08.00',
            'close' => '12.00',
            'open_2' => '14.00',
            'close_2' => '18.00',
        ]);

        $opening->insert([
            'ranking' => 2,
            'day' => 'tuesday',
            'open' => '08.00',
            'close' => '12.00',
            'open_2' => '14.00',
            'close_2' => '18.00',
        ]);

        $opening->insert([
            'ranking' => 3,
            'day' => 'wednesday',
            'open' => '08.00',
            'close' => '12.00',
        ]);

        $opening->insert([
            'ranking' => 4,
            'day' => 'thursday',
            'open' => '08.00',
            'close' => '12.00',
            'open_2' => '14.00',
            'close_2' => '18.00',
        ]);

        $opening->insert([
            'ranking' => 5,
            'day' => 'friday',
            'open' => '08.00',
            'close' => '12.00',
        ]);

    }
}
