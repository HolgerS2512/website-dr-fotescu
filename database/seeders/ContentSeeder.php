<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = DB::table('contents');
        
        // home
        $content->insert([
            'ranking' => 1,
            'page_id' => 1,
            'format' => 'subheading',
            'created_at' => Carbon::now(),
        ]);
        
        $content->insert([
            'ranking' => 2,
            'page_id' => 1,
            'format' => 'text',
            'created_at' => Carbon::now(),
        ]);
        
        $content->insert([
            'ranking' => 3,
            'page_id' => 1,
            'format' => 'cards',
            'created_at' => Carbon::now(),
        ]);
        
        $content->insert([
            'ranking' => 4,
            'page_id' => 1,
            'format' => 'buttons',
            'created_at' => Carbon::now(),
        ]);
        
        // treatments
        $content->insert([
            'ranking' => 1,
            'page_id' => 2,
            'format' => 'strip',
            'created_at' => Carbon::now(),
        ]);
        
        $content->insert([
            'ranking' => 2,
            'page_id' => 2,
            'format' => 'has_subpages',
            'created_at' => Carbon::now(),
        ]);

        // contact
        // $content->insert([
        //     'ranking' => 1,
        //     'page_id' => 7,
        //     'format' => 'address',
        //     'created_at' => Carbon::now(),
        // ]);
        // $content->insert([
        //     'ranking' => 2,
        //     'page_id' => 7,
        //     'format' => 'form',
        //     'created_at' => Carbon::now(),
        // ]);
        // $content->insert([
        //     'ranking' => 3,
        //     'page_id' => 7,
        //     'format' => 'office_hours',
        //     'created_at' => Carbon::now(),
        // ]);
        $content->insert([
            'ranking' => 1,
            'page_id' => 7,
            'format' => 'contact_collection',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'ranking' => 2,
            'page_id' => 7,
            'format' => 'cross_list',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'ranking' => 3,
            'page_id' => 7,
            'format' => 'map',
            'created_at' => Carbon::now(),
        ]);

        // transfer
        $content->insert([
            'ranking' => 1,
            'page_id' => 6,
            'format' => 'headline_text',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'ranking' => 2,
            'page_id' => 6,
            'image_id' => 26,
            'format' => 'download',
            'btn' => 'Formular',
            'url_link' => 'download/ueberweisung.pdf',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'ranking' => 3,
            'page_id' => 6,
            'format' => 'x_link',
            'url_link' => '2',
            'created_at' => Carbon::now(),
        ]);

        // praxis_&_team
        $content->insert([
            'ranking' => 1,
            'page_id' => 5,
            'format' => 'headline_text',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'ranking' => 2,
            'page_id' => 5,
            'format' => 'headline_text',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'ranking' => 3,
            'page_id' => 5,
            'format' => 'headline_list',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'ranking' => 4,
            'page_id' => 5,
            'image_id' => 27,
            'format' => 'image_overlap',
            'url_link' => '2',
            'created_at' => Carbon::now(),
        ]);

        // kost
        $content->insert([
            'ranking' => 1,
            'page_id' => 4,
            'format' => 'headline_text',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'ranking' => 3,
            'page_id' => 4,
            'format' => 'x_link',
            'url_link' => '5',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'ranking' => 2,
            'page_id' => 4,
            'format' => 'details',
            'created_at' => Carbon::now(),
        ]);
    }
}
