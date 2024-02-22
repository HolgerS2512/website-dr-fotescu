<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $publish = DB::table('words');

        $publish->insert([
            'name' => 'nav_title',
            'context' => 'Main title navigation',
            'de' => 'Dr. Sebastian Fotescu Zahnarztpraxis',
            'en' => 'Dr. Sebastian Fotescu dental practice',
        ]);

        $publish->insert([
            'name' => 'current',
            'context' => 'Text section',
            'de' => 'aktuelles',
            'en' => 'current',
        ]);

        $publish->insert([
            'name' => 'zfatreatments',
            'context' => 'Text section',
            'de' => 'Zahnarzt Behandlungen',
            'en' => 'Dentist treatments',
        ]);

        $publish->insert([
            'name' => 'read',
            'context' => 'Text section end / Button (noun | beginning of sentence | Single word)',
            'de' => 'Weiterlesen',
            'en' => 'Read more',
        ]);

        $publish->insert([
            'name' => 'location',
            'context' => 'Footer details',
            'de' => 'Standort Dresden',
            'en' => 'Dresden location',
        ]);

        $publish->insert([
            'name' => 'sitemap',
            'context' => 'Footer details (noun | beginning of sentence | Single word)',
            'de' => 'Sitemap',
            'en' => 'Sitemap',
        ]);

        $publish->insert([
            'name' => 'approach',
            'context' => 'Footer details (noun | beginning of sentence | Single word)',
            'de' => 'Anfahrt',
            'en' => 'Approach',
        ]);

        $publish->insert([
            'name' => 'copyright',
            'context' => '© Copyright 2024 Dr. Sebastian Fotescu',
            'de' => 'copyright',
            'en' => 'copyright',
        ]);

        $publish->insert([
            'name' => 'h1_subtitle',
            'context' => '(Page title) MEIN ZAHNARZT DRESDEN',
            'de' => 'MEIN ZAHNARZT DRESDEN',
            'en' => 'MY DENTIST DRESDEN',
        ]);

        $publish->insert([
            'name' => 'home_subtitle_one',
            'context' => 'Mein Zahnarzt in Dresden - Cotta (home subtitle)',
            'de' => 'Mein Zahnarzt in Dresden - Cotta',
            'en' => 'My dentist in Dresden - Cotta',
        ]);

        $publish->insert([
            'name' => 'home_subtitle_two',
            'context' => 'Für ein gesundes Lächeln. Ihre Zähne liegen uns am Herzen (home subtitle)',
            'de' => 'Für ein gesundes Lächeln.',
            'en' => 'For a healthy smile.',
        ]);

        $publish->insert([
            'name' => 'home_subtitle_three',
            'context' => 'Für ein gesundes Lächeln. Ihre Zähne liegen uns am Herzen (home subtitle)',
            'de' => 'Ihre Zähne liegen uns am Herzen.',
            'en' => 'Your teeth are important to us.',
        ]);
    }
}
