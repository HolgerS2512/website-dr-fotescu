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
            'title' => 'Zahnarzt Behandlungen',
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
    }
}
