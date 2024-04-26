<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DeListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deList = DB::table('de_lists');
        
        // subheading
        $deList->insert([
            'content_id' => 1,
            'ranking' => 1,
            'title' => 'Mein Zahnarzt in <span style="white-space: nowrap;">Dresden - Cotta</span>',
            'item_1' => 'Für ein gesundes Lächeln.',
            'item_2' => 'Ihre Zähne liegen uns am Herzen.',
            'created_at' => Carbon::now(),
        ]);
        
        // cards 
        $deList->insert([
            'content_id' => 3,
            'ranking' => 1,
            'title' => 'opening', // select via opening
            'created_at' => Carbon::now(),
        ]);
        $deList->insert([
            'content_id' => 3,
            'ranking' => 4,
            'title' => 'list',
            'image_id' => 12,
            'item_1' => 'Bis zu 3 Stunden kostenloses Parken.',
            'item_2' => 'Stellplatz direkt vor unserer Zahnarztpraxis (Ebene 3)',
            'item_3' => 'Auf mehreren Ebenen Standplätze verfügbar.',
            'item_4' => 'Immer einen freien Parkplatz auch zu Hauptverkehrszeiten.',
            'created_at' => Carbon::now(),
        ]);
        $deList->insert([
            'content_id' => 3,
            'ranking' => 5,
            'title' => 'infos', // select via infos
            'created_at' => Carbon::now(),
        ]);

        // buttons
        $deList->insert([
            'content_id' => 4,
            'ranking' => 1,
            'words_name' => 'zfatreatments',
            'item_1' => 'emergency',
            'item_2' => 'family',
            'item_3' => 'prophylaxis',
            'item_4' => 'dentistry',
            'item_5' => 'periodontology',
            'item_6' => 'bleaching',
            'item_7' => 'restorative',
            'item_8' => 'implants',
            'item_9' => 'dentures',
            'created_at' => Carbon::now(),
        ]);

        // buttons_strip
        $deList->insert([
            'content_id' => 5,
            'ranking' => 1,
            'image_id' => 23,
            'item_1' => 'fürsorliche<br>Behandlungen',
            'item_2' => 'individuelle<br>Beratung',
            'item_3' => 'kompetente<br>Betreuung',
            'item_4' => 'kinder-<br>freundlich',
            'item_5' => 'familien<br>orientiert',
            'created_at' => Carbon::now(),
        ]);

        // contact cross_list
        $deList->insert([
            'content_id' => 8,
            'ranking' => 1,
            'item_1' => 'Linie 1',
            'item_2' => 'Linie 6',
            'item_3' => 'Linie 8',
            'item_4' => 'Linie 11',
            'item_5' => 'Linie 2',
            'item_6' => 'Linie 7',
            'item_7' => 'Linie 10',
            'item_8' => 'Linie 12',
            'created_at' => Carbon::now(),
        ]);

        // praxis_&_team headline_list
        $deList->insert([
            'content_id' => 15,
            'ranking' => 1,
            'image_id' => 12,
            'title' => 'Warum unsere<br>Zahnarztpraxis deine Wahl sein sollte?',
            'item_1' => 'Hervorragende Beratung durch fachliche Kompetenz.',
            'item_2' => 'Eine schmerzfreie und blendende medizinische Versorgung.',
            'item_3' => 'Ein angenehmes und wohlfühlendes Praxisklima.',
            'item_4' => 'Eine beruhigende und stressfreie Behandlung.',
            'item_5' => 'Ein freundliches und zuvorkommendes Praxisteam.',
            'item_6' => 'Eine ausgezeichnete Pflege, Zahnbehandlung und Vorsorge.',
            'created_at' => Carbon::now(),
        ]);

        // prophylaxis headline_image
        $deList->insert([
            'content_id' => 29,
            'ranking' => 1,
            'item_1' => 'Ihre medizinische und zahnmedizinische Vorgeschichte überprüfen',
            'item_2' => 'den aktuellen Gesundheitszustand Ihres Mundes, Ihres Zahnfleisches und des umliegenden Gewebes beurteilen',
            'item_3' => 'Behandlung, einschließlich Polieren der Zähne',
            'item_4' => 'Aufklärung der Patienten über die Mundgesundheit, einschließlich der richtigen Mundpflegetechniken für zu Hause und Empfehlungen für Produkte zur Vorbeugung künftiger Probleme',
            'item_5' => 'Wir schicken Sie nach Ihrem Termin mit einem maßgeschneiderten Behandlungsplan nach Hause, um Ihre Mundgesundheit und Ihren frischen Atem zu erhalten',
            'item_6' => 'bei Bedarf eine fachärztliche Behandlung empfehlen',
            'created_at' => Carbon::now(),
        ]);
        $deList->insert([
            'content_id' => 31,
            'ranking' => 1,
            'item_1' => 'Schlechten Atem (Halitosis)',
            'item_2' => 'Sichtbare Ablagerungen von Plaque und Zahnstein',
            'item_3' => 'Verfärbte Zähne',
            'item_4' => 'Zahnfleischbluten',
            'item_5' => 'Zurückgehendes Zahnfleisch',
            'item_6' => 'Empfindliche Zähne',
            'item_7' => 'Zahnverfall',
            'created_at' => Carbon::now(),
        ]);
        $deList->insert([
            'content_id' => 32,
            'ranking' => 1,
            'item_1' => 'Herzkrankheiten',
            'item_2' => 'Schlaganfälle',
            'item_3' => 'Generalisierte Entzündungen',
            'item_4' => 'Rheumatoide Arthritis',
            'created_at' => Carbon::now(),
        ]);
    }
}
