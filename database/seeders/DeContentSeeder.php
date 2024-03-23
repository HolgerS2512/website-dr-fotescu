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
        
        $deContent->insert([
            'content_id' => 1,
            'title' => 'Mein Zahnarzt in Dresden&nbsp;-&nbsp;Cotta',
            'content' => 'Für ein gesundes Lächeln.\nIhre Zähne liegen uns am Herzen',
            'created_at' => Carbon::now(),
        ]);
        
        $deContent->insert([
            'content_id' => 2,
            'title' => 'Aktuelles',
            'content' => 'Seit der Übernahme der Zahnarztpraxis von Dr. Wünschmann am 01.01.2023 wurde die Praxis grundlegend modernisiert und digitalisiert, u.a. durch den Umzug der Zahnarztpraxis in einen größeren Raum nur eine Ebene tiefer neben der Apotheke. Mit 20 Jahren Erfahrung als Zahnarzt im Vereinigten Königreich freut sich der neue Inhaber der Praxis Dr. Sebastian Fotescu, unseren Patienten das Beste der Zahnmedizin zu bieten. Frau Dr. Wünschmann arbeitet weiterhin als angestellte Zahnärztin in unserer Praxis, so dass die Patienten auch von ihrer großen Erfahrung und ihrem Wissen profitieren können. Unser Ziel ist es, eine qualitativ hochwertige und wirksame Behandlung in einer sicheren Umgebung anzubieten, um Ihren Besuch so angenehm und effektiv wie möglich zu gestalten. Wir behandeln Sie als Individuum und gehen bei jedem Schritt auf Ihre Sorgen und Erwartungen ein.',
            'created_at' => Carbon::now(),
        ]);
    }
}
