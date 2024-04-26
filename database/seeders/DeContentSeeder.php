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

        // emergency
        $deContent->insert([
            'content_id' => 25,
            'ranking' => 1,
            'title' => 'Zahnärztliche<br>Notfallversorgung',
            'content' => 'Von Zahnschmerzen bis hin zu Abszessen und Zungenbissen - in unserer Zahnarztpraxis kümmern wir uns um Sie und können Ihnen helfen, Ihr zahnmedizinisches Notfallproblem zu lösen.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 26,
            'ranking' => 1,
            'title' => 'Haben Sie<br>jetzt Zahnschmerzen?',
            'content' => 'Dann melden Sie sich jetzt vorab telefonisch an!<br>Machen Sie einen Termin oder kommen Sie noch heute vorbei und wir schauen uns gemeinsam Ihr Anliegen an. Zusammen finden wir schnell eine geeignete Lösung, mit einer herausragenden Behandlung und dem Ziel einen schmerzfreien Tag genießen zu können.',
            'created_at' => Carbon::now(),
        ]);

        // prophylaxis
        $deContent->insert([
            'content_id' => 27,
            'ranking' => 1,
            'title' => 'Über diese Behandlung ',
            'content' => 'Selbst die beste Zahnbürste kann nicht jeden Teil Ihres Mundes erreichen, und orale Probleme müssen erkannt werden, bevor sie behandelt werden müssen. Unsere Dentalhygienikerinnen erreichen auch die schwer zugänglichen Stellen und sorgen für eine hochwertige professionelle Tiefenreinigung.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 28,
            'ranking' => 1,
            'title' => 'Saubere Zähne, frischer Atem',
            'content' => 'Unsere Dentalhygienikerinnen sind speziell dafür ausgebildet, Ihre Zähne und Ihr Zahnfleisch viel gründlicher zu reinigen, als Sie es zu Hause tun könnten, und gleichzeitig auf frühe Warnzeichen für ernstere Entwicklungen wie Zahnfleischerkrankungen und sogar Mundkrebs zu achten.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 28,
            'ranking' => 2,
            'content' => 'In unserer Praxis gehören eine vollständige Zahnsteinentfernung und eine Politur zum Standardprogramm. Außerdem können wir mit der neuesten Air-Flow-Technologie den Biofilm entfernen und unseren Patienten ein perfektes "sauberes" Gefühl geben.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 28,
            'ranking' => 3,
            'content' => 'Neben einer gründlichen häuslichen Mundhygiene, zu der das zweimal tägliche Putzen der Zähne mit einer fluoridhaltigen Zahnpasta, einer geeigneten Zahnbürste, Mundwasser und mindestens einmal täglicher Verwendung von Zahnseide gehört, ist es wichtig, regelmäßig zur Zahnhygienikerin zu gehen, um künftige Probleme und die hartnäckige Bildung von schwer erreichbarem Zahnbelag und Zahnstein zu verhindern.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 28,
            'ranking' => 4,
            'content' => 'Interesse geweckt? Tun Sie Ihren Zähnen etwas gutes!',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 29,
            'ranking' => 1,
            'title' => 'Was beinhaltet<br>eine Dentalhygiene Behandlung?',
            'content' => '<headline>Während Ihres Termins wird unsere professionelle Zahnhygienikerin:',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 29,
            'ranking' => 2,
            'content' => 'In unserer Praxis gehören eine vollständige Zahnsteinentfernung und eine Politur zum Standardprogramm. Außerdem können wir mit der neuesten Air-Flow-Technologie den Biofilm entfernen und unseren Patienten ein perfektes "sauberes" Gefühl geben.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 29,
            'ranking' => 3,
            'content' => 'Neben einer gründlichen häuslichen Mundhygiene, zu der das zweimal tägliche Putzen der Zähne mit einer fluoridhaltigen Zahnpasta, einer geeigneten Zahnbürste, Mundwasser und mindestens einmal täglicher Verwendung von Zahnseide gehört, ist es wichtig, regelmäßig zur Zahnhygienikerin zu gehen, um künftige Probleme und die hartnäckige Bildung von schwer erreichbarem Zahnbelag und Zahnstein zu verhindern.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 29,
            'ranking' => 4,
            'content' => 'Interesse geweckt? Tun Sie Ihren Zähnen etwas gutes!',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 30,
            'ranking' => 1,
            'title' => 'Warum ist die<br>Mundhygiene so wichtig?',
            'content' => 'Eine gute Zahnhygiene ist von entscheidender Bedeutung, denn eine schlechte Mundhygiene kann zu peinlichen und potenziell ernsten Beschwerden führen. Diese Symptome können Ihr soziales Leben und Ihre täglichen Aktivitäten beeinträchtigen, das Essen und Sprechen erschweren und Sie in Bezug auf Ihr Lächeln verunsichern. Eines der ernsteren Probleme sind die Auswirkungen, die eine schlechte Zahngesundheit auf Ihre allgemeine Gesundheit haben kann.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 30,
            'ranking' => 2,
            'content' => 'Eine gute Mundgesundheit verringert das Risiko von Zahnfleischerkrankungen, schlechtem Atem, Karies und sogar Mundkrebs.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 31,
            'ranking' => 1,
            'title' => 'Schlechte Mundhygiene<br>kann Folgendes verursachen:',
            'content' => 'Eine gute Zahnhygiene ist von entscheidender Bedeutung, denn eine schlechte Mundhygiene kann zu peinlichen und potenziell ernsten Beschwerden führen. Diese Symptome können Ihr soziales Leben und Ihre täglichen Aktivitäten beeinträchtigen, das Essen und Sprechen erschweren und Sie in Bezug auf Ihr Lächeln verunsichern. Eines der ernsteren Probleme sind die Auswirkungen, die eine schlechte Zahngesundheit auf Ihre allgemeine Gesundheit haben kann.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 31,
            'ranking' => 2,
            'content' => 'Eine gute Mundgesundheit verringert das Risiko von Zahnfleischerkrankungen, schlechtem Atem, Karies und sogar Mundkrebs.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 32,
            'ranking' => 1,
            'title' => 'Zahnfleischerkrankung',
            'content' => 'Schlechte Zahnreinigung kann ein Nährboden für Bakterien sein, und wenn Sie Ihre Mundhygiene vernachlässigen oder ignorieren, kann dies im Laufe der Zeit zu einer Zahnfleischerkrankung führen (auch bekannt als Parodontose oder Parodontitis). Die mit Parodontitis verbundenen Bakterien können über blutendes Zahnfleisch in den Blutkreislauf gelangen und werden mit den folgenden Erkrankungen in Verbindung gebracht:',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 33,
            'ranking' => 1,
            'title' => 'AirFlow-Technologie',
            'content' => 'Ein weiterer Vorteil eines Besuchs in unserer Praxis ist, dass wir die neueste AirFlow-Technologie verwenden, bei der ein feiner Luftstrom mit Wasser und feinem Pulver gemischt wird, um Ihre Zähne richtig zu polieren und Flecken und Plaque/Biofilm zu entfernen. AirFlow bietet eine sanftere und effektivere Zahnreinigung als herkömmliche Zahnsteinentfernung und Politur und kann weiter unter den Zahnfleischrand vordringen als herkömmliche Zahnsteinentfernung.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 33,
            'ranking' => 2,
            'content' => 'Interesse an weitere Behandlungsmöglichkeiten? Hier können Sie weiterlesen.',
            'created_at' => Carbon::now(),
        ]);

        // bleaching
        $deContent->insert([
            'content_id' => 34,
            'ranking' => 1,
            'title' => 'Optionen zur<br>Verbesserung des Lächelns',
            'content' => 'Die Zahnaufhellung kann von vielen Faktoren abhängen, darunter Ihre Lebensgewohnheiten, die aktuelle Farbe Ihrer Zähne und das gewünschte Ergebnis.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 34,
            'ranking' => 2,
            'content' => 'Es gibt viele Möglichkeiten, das Aussehen Ihrer Zähne zu verbessern, von der Entfernung oberflächlicher Verfärbungen über die Aufhellung der inneren Pigmente der Zähne bis hin zu komplexeren restaurativen Methoden.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 34,
            'ranking' => 3,
            'content' => 'Unsere professionellen Bleaching-Behandlungen sind sicher und wirksam. Sie werden auch auf Ihre speziellen zahnmedizinischen Bedürfnisse zugeschnitten, wobei alle Komplikationen der Mundgesundheit und die Anforderungen an die Beurteilung berücksichtigt werden, bevor Sie Ihre Reise zum "perfekten Lächeln" antreten.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 34,
            'ranking' => 4,
            'content' => 'Um mehr über Ihre Möglichkeiten zu erfahren, vereinbaren Sie bitte einen Konsultationstermin mit uns.',
            'created_at' => Carbon::now(),
        ]);

        // dentures
        $deContent->insert([
            'content_id' => 36,
            'ranking' => 1,
            'content' => 'Fehlende Zähne können Ihr Lächeln beeinträchtigen. In unserer Praxis bieten wir Ihnen eine Reihe von Lösungen für fehlende Zähne wie Zahnimplantate, Zahnbrücken und Prothesen.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 37,
            'ranking' => 1,
            'title' => 'Prothesen oder<br>herausnehmbarer Zahnersatz',
            'content' => 'Herausnehmbarer Zahnersatz kommt zum Einsatz, wenn festsitzender Zahnersatz nicht möglich ist, eine große Anzahl von Zähnen fehlt oder die vorhandenen Zähne zu schwach sind, um festsitzenden Zahnersatz zu tragen. Das Spektrum reicht von Teilprothesen bis zu Vollprothesen. Die Totalprothese stützt sich ausschließlich auf das Zahnfleisch, während die Teilprothese auch von den vorhandenen Zähnen getragen wird. Teilprothesen werden mit verschiedenen Verankerungselementen an den Restzähnen befestigt. Klammern ermöglichen eine einfache Verankerung, ohne die vorhandene Zahnsubstanz weiter zu schwächen. Komfortablere Verankerungselemente sind Teleskope. Sie erfordern in der Regel den Abbau von Zahnsubstanz.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 37,
            'ranking' => 2,
            'content' => 'Für mehr Informationen buchen Sie bitte einen Konsultationstermin bei uns.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 38,
            'ranking' => 1,
            'title' => 'Zahnbrücke oder<br>festsitzender Zahnersatz',
            'content' => 'Was ist eine Brücke? Wenn ein Zahn fehlt und die benachbarten Zähne überkront werden müssen, kann es sein, dass eine Brücke, die von den benachbarten Zähnen getragen wird, die beste Möglichkeit ist, den fehlenden Zahn zu ersetzen. Bei einer konventionellen Brücke wird der festsitzende künstliche Zahn durch Beschleifen des/der benachbarten Zahns/Zähne fixiert, damit er an seinen Platz passt.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 39,
            'ranking' => 1,
            'title' => 'Eine Alternative<br>Option sind Zahnimplantate',
            'content' => 'Was ist ein Zahnimplantat? Ein festsitzender künstlicher Zahn, der von einer Schraube im Kiefer gehalten wird.',
            'created_at' => Carbon::now(),
        ]);

        // implants
        $deContent->insert([
            'content_id' => 40,
            'ranking' => 1,
            'title' => 'Was ist ein Zahnimplantat?<br>Ein festsitzender künstlicher Zahn,<br>der von einer Schraube im Kiefer gehalten wird.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 41,
            'ranking' => 1,
            'title' => 'Lösung<br>für einzelne Zähne',
            'content' => 'Wenn ein Zahn und seine Wurzel fehlen, stellt eine auf einem Zahnimplantat befestigte Krone eine hervorragende ästhetische und funktionelle Lösung dar. Das Zahnimplantat ersetzt die fehlende Zahnwurzel, und die gesunden Nachbarzähne bleiben vollständig intakt und müssen nicht angetastet werden.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 42,
            'ranking' => 1,
            'title' => 'Lösung<br>für mehrere Zähne',
            'content' => 'Wenn zwei oder mehr Zähne fehlen, muss die Lücke so schnell wie möglich geschlossen werden, um Fehlstellungen von Zähnen und Kieferknochen zu vermeiden. Mit einer implantatgetragenen Brücke kann eine Mehrzahnlücke geschlossen werden, wobei die gesunden Nachbarzähne unangetastet bleiben. Alternativ kann auch eine Teilprothese auf Zahnimplantaten getragen und auf Wunsch des Patienten entfernt werden. Beide Lösungen bieten wesentlich mehr Stabilität als herkömmlicher Zahnersatz.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 43,
            'ranking' => 1,
            'title' => 'Lösung<br>für alle Zähne',
            'content' => 'Wenn der Kiefer völlig zahnlos ist, können Zahnimplantate ein komplettes Gebiss stützen oder eine herausnehmbare Prothese befestigen.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 44,
            'ranking' => 1,
            'title' => 'Die Vorteile<br>von Zahnimplantaten:',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 44,
            'ranking' => 2,
            'content' => '<headline>1. Den natürlichen Zähnen am ähnlichsten',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 44,
            'ranking' => 3,
            'content' => 'Nach Abschluss der Behandlung sieht das Ergebnis völlig natürlich aus und ist optisch nicht von Ihren natürlichen Zähnen zu unterscheiden.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 44,
            'ranking' => 4,
            'content' => '<headline>2. Verhinderung von Knochenschwund',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 44,
            'ranking' => 5,
            'content' => 'Wenn der Zahn nicht im Knochen ersetzt wird, folgt auf den Zahnverlust unweigerlich ein Knochenverlust. Zahnimplantate können den Knochen dazu anregen, sich selbst wieder aufzubauen und gesund zu bleiben, indem sie mit dem Kieferknochen verwachsen und ihn stabilisieren.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 44,
            'ranking' => 6,
            'content' => '<headline>3. Stärke und Funktion',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 44,
            'ranking' => 7,
            'content' => 'Zahnimplantate werden zu einem Teil des Kieferknochens und bieten so eine dauerhafte Lösung für den Zahnverlust - im Gegensatz zu Prothesen oder Brücken, die möglicherweise ersetzt oder neu angefertigt werden müssen.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 44,
            'ranking' => 8,
            'content' => '<headline>4. Leichte Pflege',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 44,
            'ranking' => 9,
            'content' => 'Die Pflege von Implantatzähnen unterscheidet sich nicht von der Pflege Ihrer natürlichen Zähne. Sie müssen sie täglich putzen und mit Zahnseide reinigen, aber Sie müssen keine speziellen Cremes und Klebstoffe auftragen oder sie über Nacht in einem Glas einweichen, wie es bei Zahnersatz der Fall ist. Sie brauchen auch nie eine Füllung oder eine Wurzelbehandlung, wie es bei den natürlichen Zähnen, die eine Brücke tragen, der Fall sein kann.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 44,
            'ranking' => 10,
            'content' => '<headline>5. Unterstützung der Gesichtsstruktur',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 44,
            'ranking' => 11,
            'content' => 'Wenn der Knochen unter einem verlorenen Zahn zu schwinden beginnt, kann das Ihr Gesicht eingefallen und vorzeitig gealtert aussehen lassen und Ihren Kiefer sogar anfälliger für Brüche machen, wenn er lange genug unbehandelt bleibt. Mit Zahnimplantaten lässt sich dies verhindern und sogar rückgängig machen, so dass Sie länger jünger aussehen.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 44,
            'ranking' => 12,
            'content' => '<headline>6. Sicher für die Zähne',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 44,
            'ranking' => 13,
            'content' => 'Zahnimplantate haben keine Auswirkungen auf die Gesundheit der natürlichen Nachbarzähne. Andere Zahnersatzmöglichkeiten können jedoch die Nachbarzähne schwächen und sie anfälliger für Karies machen.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 44,
            'ranking' => 14,
            'content' => '<headline>7. Langlebig',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 44,
            'ranking' => 15,
            'content' => 'Mit der richtigen Pflege haben Zahnimplantate das Potenzial, ein Leben lang zu halten.',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 44,
            'ranking' => 16,
            'content' => '<headline>8. Lebensqualität',
            'created_at' => Carbon::now(),
        ]);
        $deContent->insert([
            'content_id' => 44,
            'ranking' => 17,
            'content' => 'Mit Implantaten können Sie selbstbewusst essen, sprechen und lächeln, weil sie nicht verrutschen oder sich verschieben, wie es bei herausnehmbarem Zahnersatz oft der Fall ist.',
            'created_at' => Carbon::now(),
        ]);
        
    }
}
