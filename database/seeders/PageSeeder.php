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

        $page->insert([
            'ranking' => 1,
            'de' => 'Home',
            'en' => 'Home',
            'link' => 'home',
            'weblink' => 'home',
        ]);
        $page->insert([
            'ranking' => 2,
            'any_pages' => 1,
            'de' => 'Behandlungen',
            'en' => 'Treatments',
            'link' => 'treatments',
            'weblink' => 'behandlungen',
        ]);
        $page->insert([
            'ranking' => 3,
            'de' => 'Blog',
            'en' => 'Blog',
            'link' => 'blog',
            'weblink' => 'blog',
        ]);
        $page->insert([
            'ranking' => 4,
            'de' => 'Kosten',
            'en' => 'Cost',
            'link' => 'cost',
            'weblink' => 'kosten',
        ]);
        $page->insert([
            'ranking' => 5,
            'de' => 'Praxis & Team',
            'en' => 'Practice & Team',
            'link' => 'team',
            'weblink' => 'praxis_&_team',
        ]);
        $page->insert([
            'ranking' => 6,
            'de' => 'Überweisung',
            'en' => 'Transfer',
            'link' => 'transfer',
            'weblink' => 'ueberweisung',
        ]);
        $page->insert([
            'ranking' => 7,
            'de' => 'Kontakt',
            'en' => 'Contact',
            'link' => 'contact',
            'weblink' => 'kontakt',
        ]);
        $page->insert([
            'ranking' => 8,
            'de' => 'Datenschutz',
            'en' => 'Privacy Policy',
            'link' => 'privacy',
            'weblink' => 'datenschutz',
        ]);
        $page->insert([
            'ranking' => 9,
            'de' => 'Impressum',
            'en' => 'Imprint',
            'link' => 'imprint',
            'weblink' => 'impressum',
        ]);
    }
}
