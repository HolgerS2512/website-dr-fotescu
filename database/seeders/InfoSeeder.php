<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('infos')->insert([
            'location' => '(Sachsen-Forum)',
            'address' => 'Merianplatz 4 ',
            'zip' => '01169',
            'city' => 'Dresden',
            'country' => '',
            'phone' => '+493514117383',
            'mail' => 'kontakt@MeinZahnarztDresden.de',
        ]);
    }
}
