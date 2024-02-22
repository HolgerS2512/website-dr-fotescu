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
            'en_name' => 'Home',
            'link' => 'home',
        ]);
        $page->insert([
            'ranking' => 2,
            'name' => 'Behandlungen',
            'en_name' => 'Treatments',
            'link' => 'treatments',
        ]);
        $page->insert([
            'ranking' => 3,
            'name' => 'Blog',
            'en_name' => 'Blog',
            'link' => 'blog',
        ]);
        $page->insert([
            'ranking' => 4,
            'name' => 'Kosten',
            'en_name' => 'Cost',
            'link' => 'cost',
        ]);
        $page->insert([
            'ranking' => 5,
            'name' => 'Praxis & Team',
            'en_name' => 'Practice & Team',
            'link' => 'team',
        ]);
        $page->insert([
            'ranking' => 6,
            'name' => 'Überweisung',
            'en_name' => 'Transfer',
            'link' => 'transfer',
        ]);
        $page->insert([
            'ranking' => 7,
            'name' => 'Kontakt',
            'en_name' => 'Contact',
            'link' => 'contact',
        ]);
        $page->insert([
            'ranking' => 8,
            'name' => 'Datenschutz',
            'en_name' => 'Privacy Policy',
            'link' => 'privacy',
        ]);
        $page->insert([
            'ranking' => 9,
            'name' => 'Impressum',
            'en_name' => 'Imprint',
            'link' => 'imprint',
        ]);

        // Subpages

        $page->insert([
            'ranking' => 1,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Notfallversorgung',
            'en_name' => 'Emergency care',
            'link' => 'emergency',
        ]);
        $page->insert([
            'ranking' => 2,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Familientermine',
            'en_name' => 'Family appointments',
            'link' => 'family',
        ]);
        $page->insert([
            'ranking' => 3,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Prophylaxe/Mundhygiene',
            'en_name' => 'Prophylaxis/Oral hygiene',
            'link' => 'prophylaxis',
        ]);
        $page->insert([
            'ranking' => 4,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Allgemeine Zahnheilkunde',
            'en_name' => 'General dentistry',
            'link' => 'dentistry',
        ]);
        $page->insert([
            'ranking' => 5,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Zahnfleischbehandlung',
            'en_name' => 'Gum treatment',
            'link' => 'periodontology',
        ]);
        $page->insert([
            'ranking' => 6,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Zahnaufhellung (Bleaching)',
            'en_name' => 'Bleaching',
            'link' => 'bleaching',
        ]);
        $page->insert([
            'ranking' => 7,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Restaurative Zahnheilkunde',
            'en_name' => 'Restorative dentistry',
            'link' => 'restorative',
        ]);
        $page->insert([
            'ranking' => 8,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Zahnimplantate',
            'en_name' => 'Dental implants',
            'link' => 'implants',
        ]);
        $page->insert([
            'ranking' => 9,
            'subpage' => 1,
            'page_id' => 2,
            'name' => 'Zahnersatz',
            'en_name' => 'Dentures',
            'link' => 'dentures',
        ]);
    }
}
