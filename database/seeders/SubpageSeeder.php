<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SubpageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = DB::table('subpages');

        // treatments
        $page->insert([
            'ranking' => 1,
            'page_id' => 2,
            'link' => 'emergency',
            'weblink' => 'behandlungen/notfallversorgung',
            'de' => 'Notfallversorgung',
            'en' => 'Emergency care',
            'created_at' => Carbon::now(),
        ]);
        $page->insert([
            'ranking' => 2,
            'page_id' => 2,
            'link' => 'family',
            'weblink' => 'behandlungen/familientermine',
            'de' => 'Familientermine',
            'en' => 'Family appointments',
            'created_at' => Carbon::now(),
        ]);
        $page->insert([
            'ranking' => 3,
            'page_id' => 2,
            'link' => 'prophylaxis',
            'weblink' => 'behandlungen/prophylaxe',
            'de' => 'Prophylaxe/Mundhygiene',
            'en' => 'Prophylaxis/Oral hygiene',
            'created_at' => Carbon::now(),
        ]);
        $page->insert([
            'ranking' => 4,
            'page_id' => 2,
            'link' => 'dentistry',
            'weblink' => 'behandlungen/allgemeine_zahnheilkunde',
            'de' => 'Allgemeine Zahnheilkunde',
            'en' => 'General dentistry',
            'created_at' => Carbon::now(),
        ]);
        $page->insert([
            'ranking' => 5,
            'page_id' => 2,
            'link' => 'periodontology',
            'weblink' => 'behandlungen/parodontologie',
            'de' => 'Zahnfleischbehandlung',
            'en' => 'Gum treatment',
            'created_at' => Carbon::now(),
        ]);
        $page->insert([
            'ranking' => 6,
            'page_id' => 2,
            'link' => 'bleaching',
            'weblink' => 'behandlungen/bleaching',
            'de' => 'Zahnaufhellung (Bleaching)',
            'en' => 'Bleaching',
            'created_at' => Carbon::now(),
        ]);
        $page->insert([
            'ranking' => 7,
            'page_id' => 2,
            'link' => 'restorative',
            'weblink' => 'behandlungen/restaurative_zahnheilkunde',
            'de' => 'Restaurative Zahnheilkunde',
            'en' => 'Restorative dentistry',
            'created_at' => Carbon::now(),
        ]);
        $page->insert([
            'ranking' => 8,
            'page_id' => 2,
            'link' => 'implants',
            'weblink' => 'behandlungen/implantate',
            'de' => 'Zahnimplantate',
            'en' => 'Dental implants',
            'created_at' => Carbon::now(),
        ]);
        $page->insert([
            'ranking' => 9,
            'page_id' => 2,
            'link' => 'dentures',
            'weblink' => 'behandlungen/zahnersatz',
            'de' => 'Zahnersatz',
            'en' => 'Dentures',
            'created_at' => Carbon::now(),
        ]);
    }
}
