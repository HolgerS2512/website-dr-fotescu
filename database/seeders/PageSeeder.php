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
    }
}
