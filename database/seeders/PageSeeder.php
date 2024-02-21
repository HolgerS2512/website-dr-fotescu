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
        ]);
        $page->insert([
            'ranking' => 2,
            'name' => 'Treatments',
            'link' => 'treatments',
        ]);
        $page->insert([
            'ranking' => 3,
            'name' => 'Blog',
            'link' => 'blog',
        ]);
        $page->insert([
            'ranking' => 4,
            'name' => 'Cost',
            'link' => 'cost',
        ]);
        $page->insert([
            'ranking' => 5,
            'name' => 'Practice & Team',
            'link' => 'team',
        ]);
        $page->insert([
            'ranking' => 6,
            'name' => 'Transfer',
            'link' => 'transfer',
        ]);
        $page->insert([
            'ranking' => 7,
            'name' => 'Contact',
            'link' => 'contact',
        ]);
        $page->insert([
            'ranking' => 8,
            'name' => 'Privacy Policy',
            'link' => 'privacy',
        ]);
        $page->insert([
            'ranking' => 9,
            'name' => 'Impressum',
            'link' => 'imprint',
        ]);

        // Subpages

        $page->insert([
            'ranking' => 1,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Notfallversorgung',
            'link' => 'emergency',
        ]);
        $page->insert([
            'ranking' => 2,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Familientermine',
            'link' => 'family',
        ]);
        $page->insert([
            'ranking' => 3,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Prophylaxe/Mundhygiene',
            'link' => 'prophylaxis',
        ]);
        $page->insert([
            'ranking' => 4,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Allgemeine Zahnheilkunde',
            'link' => 'dentistry',
        ]);
        $page->insert([
            'ranking' => 5,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Zahnfleischbehandlung',
            'link' => 'periodontology',
        ]);
        $page->insert([
            'ranking' => 6,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Zahnaufhellung (Bleaching)',
            'link' => 'bleaching',
        ]);
        $page->insert([
            'ranking' => 7,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Restaurative Zahnheilkunde',
            'link' => 'restorative',
        ]);
        $page->insert([
            'ranking' => 8,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Zahnimplantate',
            'link' => 'implants',
        ]);
        $page->insert([
            'ranking' => 9,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Zahnersatz',
            'link' => 'dentures',
        ]);
    }
}
