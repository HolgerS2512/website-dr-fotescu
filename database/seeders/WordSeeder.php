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
            'context' => 'Logo title navigation and Startpage main title (reverse dental practice)',
            'de' => 'Dr. Sebastian Fotescu Zahnarztpraxis',
            'en' => 'Dr. Sebastian Fotescu dental practice',
        ]);

        $publish->insert([
            'name' => 'main_title',
            'context' => 'Main title',
            'de' => 'Zahnarztpraxis Dr. Sebastian Fotescu',
            'en' => 'Dental practice Dr. Sebastian Fotescu',
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
            'name' => 'tel',
            'context' => 'on page home card section contact',
            'de' => 'Tel',
            'en' => 'Phone',
        ]);

        $publish->insert([
            'name' => 'tel_long',
            'context' => 'Contact page address word',
            'de' => 'Telefon',
            'en' => 'Phone',
        ]);

        $publish->insert([
            'name' => 'mail',
            'context' => 'on page home card section contact',
            'de' => 'E-Mail',
            'en' => 'E-Mail',
        ]);

        $publish->insert([
            'name' => 'time',
            'context' => 'on page home card section office hours',
            'de' => 'Uhr',
            'en' => 'Clock',
        ]);

        $publish->insert([
            'name' => 'copyright',
            'context' => '© Copyright 2024 Dr. Sebastian Fotescu',
            'de' => 'copyright',
            'en' => 'copyright',
        ]);

        $publish->insert([
            'name' => 'h1_subtitle',
            'context' => '(Page subtitle) MEIN ZAHNARZT DRESDEN',
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

        $publish->insert([
            'name' => 'monday',
            'context' => 'kontakt info',
            'de' => 'Montag',
            'en' => 'Monday',
        ]);

        $publish->insert([
            'name' => 'tuesday',
            'context' => 'kontakt info',
            'de' => 'Dienstag',
            'en' => 'Tuesday',
        ]);

        $publish->insert([
            'name' => 'wednesday',
            'context' => 'kontakt info',
            'de' => 'Mittwoch',
            'en' => 'Wednesday',
        ]);

        $publish->insert([
            'name' => 'thursday',
            'context' => 'kontakt info',
            'de' => 'Donnerstag',
            'en' => 'Thursday',
        ]);

        $publish->insert([
            'name' => 'friday',
            'context' => 'kontakt info',
            'de' => 'Freitag',
            'en' => 'Friday',
        ]);

        $publish->insert([
            'name' => 'opening_hours_additional',
            'context' => 'kontakt info',
            'de' => 'und nach Vereinbarung!',
            'en' => 'and by appointment!',
        ]);

        $publish->insert([
            'name' => 'page_title_blog',
            'context' => 'Page title Blog',
            'de' => 'Unser Blog',
            'en' => 'Our Blog',
        ]);

        $publish->insert([
            'name' => 'meta_data',
            'context' => 'Description texts that appear in web searches (Google short description).',
            'de' => 'Herzlich willkommen bei Zahnarztpraxis Dr. Fotescu in Dresden | Ihr Zahnarzt für nette, kompetente und profesionelle Zahnmedizin | Zahnheilkunde auf dem höhsten Niveau.',
            'en' => 'Welcome to the dental practice of Dr. Fotescu in Dresden | Your dentist for friendly, competent and professional dentistry | Dentistry at the highest level.',
        ]);

        $publish->insert([
            'name' => 'seo_keywords',
            'context' => 'Web search keywords. !!! Spelling is very important !!!',
            'de' => 'zahnarztpraxis, zahnarztpraxis-dresden, zahnarzt, zahnarzt-dresden, zahnarzt-dr-fotescu',
            'en' => 'dental-practice, dental-practice-dresden, dentist, dentist-dresden, dentist-dr-fotescu',
        ]);

        $publish->insert([
            'name' => 'download_form',
            'context' => 'Transfer pdf download title',
            'de' => 'Formular herunterladen',
            'en' => 'Download form',
        ]);

        $publish->insert([
            'name' => 'make_appointment',
            'context' => 'Contact page sentence',
            'de' => 'Vereinbaren Sie ganz einfach einen Termin',
            'en' => 'Simply make an appointment',
        ]);

        $publish->insert([
            'name' => 'word_office_hours',
            'context' => 'Contact page word',
            'de' => 'Sprechzeiten',
            'en' => 'Office hours',
        ]);

        $publish->insert([
            'name' => 'gender_w',
            'de' => 'Frau',
            'en' => 'Mrs.',
        ]);

        $publish->insert([
            'name' => 'gender_m',
            'de' => 'Herr',
            'en' => 'Mr.',
        ]);

        $publish->insert([
            'name' => 'gender_d',
            'de' => 'Divers',
            'en' => 'Divers',
        ]);

        $publish->insert([
            'name' => 'first_name',
            'de' => 'Vorname',
            'en' => 'First name',
        ]);

        $publish->insert([
            'name' => 'last_name',
            'de' => 'Nachname',
            'en' => 'Last name',
        ]);

        $publish->insert([
            'name' => 'regarding',
            'de' => 'Betreff',
            'en' => 'Regarding',
        ]);

        $publish->insert([
            'name' => 'your_msg',
            'de' => 'Ihre Nachricht an uns',
            'en' => 'Your message to us',
        ]);

        $publish->insert([
            'name' => 'terms_start',
            'de' => 'Ich habe die',
            'en' => 'Regarding',
        ]);
        $publish->insert([
            'name' => 'terms_link',
            'de' => 'Datenschutz-Richtlinien',
            'en' => 'Regarding',
        ]);
        $publish->insert([
            'name' => 'terms_end',
            'de' => 'zur Kenntnis genommen und akzeptiere diese.',
            'en' => 'Regarding',
        ]);

        $publish->insert([
            'name' => 'send_btn',
            'de' => 'Abschicken',
            'en' => 'Send',
        ]);

        $publish->insert([
            'name' => 'back',
            'de' => 'Zurück',
            'en' => 'Back',
            'ru' => 'Back',
        ]);
    }
}
