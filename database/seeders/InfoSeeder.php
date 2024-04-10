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
            'phone' => '+49 351 411 73 83',
            'mail' => 'kontakt@MeinZahnarztDresden.de',
            'maps' => 'https://maps.app.goo.gl/C7szhsDCa8k6gXJ1A',
            'iframe' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2508.403676690939!2d13.667225415948115!3d51.04563365218046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4709c55957346177%3A0x1806f20232e7a29!2sZahnarztpraxis%20Dr.%20Sebastian%20Fotescu%20(ehem.%20Dres.%20W%C3%BCnschmann)!5e0!3m2!1sde!2sde!4v1679412945680!5m2!1sde!2sde',
        ]);
    }
}
