<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = DB::table('pages');

        // Main pages
        $page->insert([
            'ranking' => 1,
            'name' => 'Home',
            'link' => 'home',
            'route' => '/',
        ]);
        $page->insert([
            'ranking' => 2,
            'name' => 'Treatments',
            'link' => 'treatments',
            'route' => '/behandlungen',
        ]);
        $page->insert([
            'ranking' => 3,
            'name' => 'Blog',
            'link' => 'blog',
            'route' => '/blog',
        ]);
        $page->insert([
            'ranking' => 4,
            'name' => 'Cost',
            'link' => 'cost',
            'route' => '/kosten',
        ]);
        $page->insert([
            'ranking' => 5,
            'name' => 'Practice & Team',
            'link' => 'team',
            'route' => '/praxis_&_team',
        ]);
        $page->insert([
            'ranking' => 6,
            'name' => 'Transfer',
            'link' => 'transfer',
            'route' => '/ueberweisung',
        ]);
        $page->insert([
            'ranking' => 7,
            'name' => 'Contact',
            'link' => 'contact',
            'route' => '/kontakt',
        ]);
        $page->insert([
            'ranking' => 8,
            'name' => 'Privacy Policy',
            'link' => 'privacy',
            'route' => '/datenschutz',
        ]);
        $page->insert([
            'ranking' => 9,
            'name' => 'Impressum',
            'link' => 'imprint',
            'route' => '/impressum',
        ]);

        // Subpages

        $page->insert([
            'ranking' => 1,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Notfallversorgung',
            'link' => 'emergency',
            'route' => '/' . 'behandlungen/notfallversorgung',
        ]);
        $page->insert([
            'ranking' => 2,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Familientermine',
            'link' => 'family',
            'route' => '/' . 'behandlungen/familientermine',
        ]);
        $page->insert([
            'ranking' => 3,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Prophylaxe/Mundhygiene',
            'link' => 'prophylaxis',
            'route' => '/' . 'behandlungen/prophylaxe',
        ]);
        $page->insert([
            'ranking' => 4,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Allgemeine Zahnheilkunde',
            'link' => 'dentistry',
            'route' => '/' . 'behandlungen/allgemeine_zahnheilkunde',
        ]);
        $page->insert([
            'ranking' => 5,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Zahnfleischbehandlung',
            'link' => 'periodontology',
            'route' => '/' . 'behandlungen/parodontologie',
        ]);
        $page->insert([
            'ranking' => 6,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Zahnaufhellung (Bleaching)',
            'link' => 'bleaching',
            'route' => '/' . 'behandlungen/bleaching',
        ]);
        $page->insert([
            'ranking' => 7,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Restaurative Zahnheilkunde',
            'link' => 'restorative',
            'route' => '/' . 'behandlungen/restaurative_zahnheilkunde',
        ]);
        $page->insert([
            'ranking' => 8,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Zahnimplantate',
            'link' => 'implants',
            'route' => '/' . 'behandlungen/zahnimplantate',
        ]);
        $page->insert([
            'ranking' => 9,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Zahnersatz',
            'link' => 'dentures',
            'route' => '/' . 'behandlungen/zahnersatz',
        ]);
    }
}
