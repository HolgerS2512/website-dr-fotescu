<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DeContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deContent = DB::table('de_contents');
        
        // home
        $deContent->insert([
            'content_id' => 2,
            'ranking' => 1,
            'title' => 'Aktuelles',
            'content' => 'Seit der Übernahme der Zahnarztpraxis von Dr. Wünschmann am 01.01.2023 wurde die Praxis grundlegend modernisiert und digitalisiert, u.a. durch den Umzug der Zahnarztpraxis in einen größeren Raum nur eine Ebene tiefer neben der Apotheke. Mit 20 Jahren Erfahrung als Zahnarzt im Vereinigten Königreich freut sich der neue Inhaber der Praxis Dr. Sebastian Fotescu, unseren Patienten das Beste der Zahnmedizin zu bieten. Frau Dr. Wünschmann arbeitet weiterhin als angestellte Zahnärztin in unserer Praxis, so dass die Patienten auch von ihrer großen Erfahrung und ihrem Wissen profitieren können. Unser Ziel ist es, eine qualitativ hochwertige und wirksame Behandlung in einer sicheren Umgebung anzubieten, um Ihren Besuch so angenehm und effektiv wie möglich zu gestalten. Wir behandeln Sie als Individuum und gehen bei jedem Schritt auf Ihre Sorgen und Erwartungen ein.',
            'created_at' => Carbon::now(),
        ]);

        $deContent->insert([
            'content_id' => 3,
            'ranking' => 1,
            'title' => 'Sprechzeiten',
            'image_id' => 7,
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 3,
            'ranking' => 2,
            'title' => 'Vollständig digitalisiert',
            'content' => 'Durch die Modernisierung und Volldigitalisierung bietet die Praxis nun einen hohen Standard an Behandlungen, der sich an den aktuellen Anforderungen in der Zahnmedizin ausrichtet.',
            'image_id' => 8,
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 3,
            'ranking' => 3,
            'title' => ' Barrierefreiheit',
            'content' => 'Der Eingang befindet sich auf der oberen Ebene direkt neben der Apotheke. Der Fahrstuhl ist von jeder Etage aus barrierefrei und einfach zu erreichen.',
            'image_id' => 9,
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 3,
            'ranking' => 4,
            'title' => 'Parkmöglichkeiten',
            'image_id' => 10,
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 3,
            'ranking' => 5,
            'title' => 'Kontakt',
            'image_id' => 11,
            'created_at' => Carbon::now(),
        ]);

        // contact
        // $deContent->insert([
        //     'content_id' => 7,
        //     'ranking' => 1,
        //     'title' => 'Vereinbaren Sie ganz einfach einen Termin',
        //     'created_at' => Carbon::now(),
        // ]);
        // $deContent->insert([
        //     'content_id' => 9,
        //     'ranking' => 1,
        //     'title' => 'Sprechzeiten',
        //     'created_at' => Carbon::now(),
        // ]);
        $deContent->insert([
            'content_id' => 8,
            'ranking' => 1,
            'title' => 'Ihr Weg in unsere Zahnarztpraxis',
            'content' => 'Das Team der Zahnarztpraxis Dr. Fotescu freut sich auf Ihren Besuch. Unsere Praxis befindet sich in der obersten Etage im Sachsen Forum, welche sehr gut an den öffentlichen Nahverkehr Dresdens angebunden ist. Das Sachsen Forum bietet ausserdem, zu jeder Tageszeit ausreichend kostenfreie Parkmöglichkeiten. Sie erreichen uns ausgezeichnet mit dem Auto, Bus und der dresdner Straßenbahn. Folgende Haltestellenlinien sind in der Nähe der Zahnarztpraxis gelegen:',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 9,
            'ranking' => 1,
            'title' => 'Anfahrt',
            'created_at' => Carbon::now(),
        ]);

        // transfer
        $deContent->insert([
            'content_id' => 10,
            'ranking' => 1,
            'title' => 'Lassen Sie sich<br>in unsere Zahnarztpraxis empfehlen',
            'content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus laudantium odit quam hic, enim sequi facere dolor distinctio rem, mollitia rerum voluptates? Provident natus rerum voluptatem, illo commodi eligendi numquam.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 12,
            'ranking' => 1,
            'words_name' => 'zfatreatments',
            'content' => 'Bei uns sind Ihre Zähne in guten Händen. Hier finden Sie mehr Informationen über unsere Behandlungsmöglichkeiten. Selbstverständlich stehen wir Ihnen auch gerne persönlich zur Verfügung, um Ihre Fragen zu beantworten oder einen Termin zu vereinbaren.',
            'created_at' => Carbon::now(),
        ]);
    }
}
