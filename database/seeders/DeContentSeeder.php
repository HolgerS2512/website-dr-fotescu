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
            'content' => '',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 12,
            'ranking' => 1,
            'words_name' => 'zfatreatments',
            'content' => 'Bei uns sind Ihre Zähne in guten Händen. Hier finden Sie mehr Informationen über unsere Behandlungsmöglichkeiten. Selbstverständlich stehen wir Ihnen auch gerne persönlich zur Verfügung, um Ihre Fragen zu beantworten oder einen Termin zu vereinbaren.',
            'created_at' => Carbon::now(),
        ]);

        // praxis_&_team
        $deContent->insert([
            'content_id' => 13,
            'ranking' => 1,
            'title' => 'Herzlich Willkommen<br>in unserer Zahnarztpraxis',
            'content' => 'Mit Leidenschaft und Kompetenz für Ihre Zähne. Unser junges Praxis Team gewährleistet eine zeitnahe Versorgung bei Zahnschmerzen oder anderen dentalen Problemstellungen, wir sind sehr fürsorglich bei Kindern sowie Angstpatienten.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 14,
            'ranking' => 1,
            'title' => 'Innovatives Konzept für<br>neueste Zahnmedizin &amp; modernisierte Praxis',
            'content' => 'Seit der Übernahme der Zahnarztpraxis von Herr und Frau Dr. Wünschmann am 01.01.2023 wurde die Praxis grundlegend modernisiert und digitalisiert, u. a. durch den Umzug in größere Räumlichkeiten eine Ebene tiefer. Unsere Zahnarztpraxis liegt jetzt genau gegenüber der Apotheke auf Ebene 3.<p>Durch die Modernisierung und Volldigitalisierung bietet die Praxis nun einen hohen Standard an Behandlungsmöglichkeiten, der sich an den aktuellen und substanziellen Anforderungen in der Zahnmedizin ausrichtet.<p>Unser Ziel ist es, eine qualitativ hochwertige und heilsame Behandlung in einer sicheren Umgebung anzubieten, um Ihren Besuch so angenehm wie möglich zu gestalten. Bei uns steht der Patient an erster Stelle, wir behandeln Sie als Individuum und gehen bei jedem Schritt auf Ihre Sorgen und Erwartungen ein.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 16,
            'ranking' => 1,
            'image_id' => 28,
            'title' => 'Leidenschaftlich für gesunde Zähne',
            'content' => 'Mit stetig wachsenden Ansprüchen an Ihre Zähne, bieten wir hochwertige und langlebige spitzen Qualität. Patienten stehen bei uns an erster Stelle! Jede Behandlung ist bei uns individuell, ausgezeichnet beraten und genau auf Sie abgestimmt.<br>Hier finden Sie mehr Informationen zu unseren Behandlungsverfahren. Selbstverständlich stehen wir Ihnen auch persönlich zur Verfügung, um Ihre Fragen zu beantworten oder für Ihr Anliegen, einen Termin zu vereinbaren.',
            'created_at' => Carbon::now(),
        ]);

        // kost
        $deContent->insert([
            'content_id' => 17,
            'ranking' => 1,
            'title' => 'Hervorragende Leistungen<br>müssen nicht immer Unmengen kosten!',
            'content' => 'Mit stetig wachsenden Ansprüchen an Ihre Zähne, bieten wir hochwertige und langlebige spitzen Qualität zu fairen Kostenaufwand. Wir behandeln Patienten NICHT nach Fließband Methode! Jede Behandlung ist bei uns, eine individuell abgestimmte und spezifische Behandlung.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 18,
            'ranking' => 1,
            'title' => 'Zahnarztpraxis & Team',
            'content' => 'Der Zahnarzt unserer Praxis hat sich nach seiner Ausbildung und Studium zusätzlich umfangreiches Spezialwissen angeeignet und bildet sich auch jetzt stetig fort. Mit großer Kompetenz und Anteilnahme ist Herr Dr. Fotescu und das freundliche Praxisteam stetig für Sie bereit.<br>Hier finden Sie mehr Informationen über uns. Selbstverständlich stehen wir Ihnen auch gerne persönlich zur Verfügung, um Ihre Fragen zu beantworten oder einen Termin zu vereinbaren.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 19,
            'ranking' => 1,
            'title' => 'Details folgen in Kürze.',
            'created_at' => Carbon::now(),
        ]);

        // blog
        $deContent->insert([
            'content_id' => 20,
            'ranking' => 1,
            'title' => 'Abschnitt im Aufbau',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 22,
            'ranking' => 1,
            'title' => 'Lorem ipsum dolor sit amet consectetur',
            'content' => ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque?

            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque?
            
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque?
            
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque?
            
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque?
            
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque? ',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 22,
            'ranking' => 2,
            'title' => 'Lorem ipsum dolor sit amet consectetur',
            'content' => ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque?

            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque?
            
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque?
            
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque?
            
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque?
            
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque?',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 23,
            'ranking' => 1,
            'title' => 'Lorem ipsum dolor sit amet consectetur',
            'content' => ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque?

            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque?
            
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque?
            
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque?
            
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque?
            
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque?',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 24,
            'ranking' => 1,
            'title' => 'Lorem ipsum dolor sit amet consectetur',
            'content' => ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque?

            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque?
            
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque?
            
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque?
            
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque?
            
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis iure natus deleniti animi doloribus dolore iste eum ea ipsum. Reprehenderit animi provident deserunt aut nemo illum vero quas, harum cumque?',
            'created_at' => Carbon::now(),
        ]);
    }
}
