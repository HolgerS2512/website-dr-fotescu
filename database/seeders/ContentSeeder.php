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

        // blog
        $content->insert([
            'ranking' => 1,
            'page_id' => 3,
            'format' => 'headline_text',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'ranking' => 2,
            'page_id' => 3,
            'format' => 'blog_posts',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'page_id' => 3,
            'format' => 'post',
            'url_link' => 'lorem-ipsum-dolor-sit-amet-consectetur-adipisicing',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'page_id' => 3,
            'format' => 'post',
            'url_link' => 'lorem-ipsum-dolor-sit-reprehenderit-animi-provident',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'page_id' => 3,
            'format' => 'post',
            'url_link' => 'lorem-ipsum-dolor-sit-amet-dolor-sit-amet',
            'created_at' => Carbon::now(),
        ]);

        // emergency
        $content->insert([
            'page_id' => 2,
            'subpage_id' => 1,
            'image_id' => 29,
            'ranking' => 1,
            'format' => 'headline_image',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'page_id' => 2,
            'subpage_id' => 1,
            'image_id' => 30,
            'ranking' => 2,
            'format' => 'headline_image',
            'btn' => '7',
            'created_at' => Carbon::now(),
        ]);

        // prophylaxis
        $content->insert([
            'page_id' => 2,
            'subpage_id' => 3,
            'image_id' => 32,
            'ranking' => 1,
            'format' => 'headline_image',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'page_id' => 2,
            'subpage_id' => 3,
            'image_id' => 33,
            'ranking' => 2,
            'format' => 'headline_image',
            'btn' => '7',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'page_id' => 2,
            'subpage_id' => 3,
            'image_id' => 34,
            'ranking' => 3,
            'format' => 'headline_image',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'page_id' => 2,
            'subpage_id' => 3,
            'image_id' => 35,
            'ranking' => 4,
            'format' => 'headline_image',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'page_id' => 2,
            'subpage_id' => 3,
            'image_id' => 36,
            'ranking' => 5,
            'format' => 'headline_image',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'page_id' => 2,
            'subpage_id' => 3,
            'image_id' => 37,
            'ranking' => 6,
            'format' => 'headline_image',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'page_id' => 2,
            'subpage_id' => 3,
            'image_id' => 38,
            'ranking' => 7,
            'format' => 'headline_image',
            'btn' => '2',
            'created_at' => Carbon::now(),
        ]);

        // bleaching
        $content->insert([
            'page_id' => 2,
            'subpage_id' => 6,
            'image_id' => 39,
            'ranking' => 1,
            'format' => 'headline_image',
            'btn' => '7',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'page_id' => 2,
            'subpage_id' => 6,
            'image_id' => 40,
            'ranking' => 2,
            'format' => 'image_solo',
            'created_at' => Carbon::now(),
        ]);

        // dentures
        $content->insert([
            'page_id' => 2,
            'subpage_id' => 9,
            'image_id' => 41,
            'ranking' => 1,
            'format' => 'headline_image',
            'btn' => '7',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'page_id' => 2,
            'subpage_id' => 9,
            'image_id' => 42,
            'ranking' => 2,
            'format' => 'headline_image',
            'btn' => '7',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'page_id' => 2,
            'subpage_id' => 9,
            'image_id' => 43,
            'ranking' => 3,
            'format' => 'headline_image',
            'btn' => '7',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'page_id' => 2,
            'subpage_id' => 9,
            'image_id' => 44,
            'ranking' => 4,
            'btn' => 'subpage.8',
            'format' => 'headline_image',
            'created_at' => Carbon::now(),
        ]);

        // implants
        $content->insert([
            'page_id' => 2,
            'subpage_id' => 8,
            'image_id' => 45,
            'ranking' => 1,
            'format' => 'headline_image',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'page_id' => 2,
            'subpage_id' => 8,
            'image_id' => 46,
            'ranking' => 2,
            'format' => 'headline_image',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'page_id' => 2,
            'subpage_id' => 8,
            'image_id' => 47,
            'ranking' => 3,
            'format' => 'headline_image',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'page_id' => 2,
            'subpage_id' => 8,
            'image_id' => 48,
            'ranking' => 4,
            'format' => 'headline_image',
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'page_id' => 2,
            'subpage_id' => 8,
            'image_id' => 49,
            'ranking' => 5,
            'format' => 'headline_image',
            'created_at' => Carbon::now(),
        ]);

        // dentistry
        $content->insert([
            'page_id' => 2,
            'subpage_id' => 4,
            'image_id' => 50,
            'ranking' => 1,
            'format' => 'headline_image',
            'url_link' => 'https://www.bundesgesundheitsministerium.de/zahnvorsorgeuntersuchungen.html',
            'created_at' => Carbon::now(),
        ]);
    }
}
