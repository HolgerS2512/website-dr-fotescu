<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = DB::table('images');

        // homeslider
        $images->insert([
            'ranking' => 1,
            'page_id' => 1,
            'slide' => 1,
            'title' => 'home-slide',
            'image' => 'uploads/images/home/home-slide-zahnarzt-zahnarztpraxis-dr-sebastian-fotescu-dresden.webp',
            'created_at' => Carbon::now(),
        ]); 
        $images->insert([
            'ranking' => 2,
            'page_id' => 1,
            'slide' => 1,
            'title' => 'home-slide-2',
            'image' => 'uploads/images/home/home-slide-2-zahnarzt-zahnarztpraxis-dr-sebastian-fotescu-dresden.webp',
            'created_at' => Carbon::now(),
        ]);
        $images->insert([
            'ranking' => 3,
            'page_id' => 1,
            'slide' => 1,
            'title' => 'home-slide-3',
            'image' => 'uploads/images/home/home-slide-3-zahnarzt-zahnarztpraxis-dr-sebastian-fotescu-dresden.webp',
            'created_at' => Carbon::now(),
        ]);

        // teamslider
        $images->insert([
            'ranking' => 1,
            'page_id' => 5,
            'slide' => 1,
            'title' => 'team-slide',
            'image' => 'uploads/images/team/team-slide-zahnarzt-zahnarztpraxis-dr-sebastian-fotescu-dresden.webp',
            'created_at' => Carbon::now(),
        ]); 
        $images->insert([
            'ranking' => 2,
            'page_id' => 5,
            'slide' => 1,
            'title' => 'team-slide-2',
            'image' => 'uploads/images/team/team-slide-2-zahnarzt-zahnarztpraxis-dr-sebastian-fotescu-dresden.webp',
            'created_at' => Carbon::now(),
        ]);
        $images->insert([
            'ranking' => 3,
            'page_id' => 5,
            'slide' => 1,
            'title' => 'team-slide-3',
            'image' => 'uploads/images/team/team-slide-3-zahnarzt-zahnarztpraxis-dr-sebastian-fotescu-dresden.webp',
            'created_at' => Carbon::now(),
        ]); 

        // cards svg
        $images->insert([
            'ranking' => 1,
            'page_id' => 1,
            'content_id' => 4,
            'lang_id' => 2,
            'title' => 'calendar',
            'image' => 'uploads/images/svg/calendar.svg',
            'created_at' => Carbon::now(),
        ]); 
        $images->insert([
            'ranking' => 2,
            'page_id' => 1,
            'content_id' => 4,
            'lang_id' => 3,
            'title' => 'wlan',
            'image' => 'uploads/images/svg/wlan.svg',
            'created_at' => Carbon::now(),
        ]); 
        $images->insert([
            'ranking' => 3,
            'page_id' => 1,
            'content_id' => 4,
            'lang_id' => 4,
            'title' => 'wheelchair',
            'image' => 'uploads/images/svg/wheelchair.svg',
            'created_at' => Carbon::now(),
        ]); 
        $images->insert([
            'ranking' => 4,
            'page_id' => 1,
            'content_id' => 4,
            'lang_id' => 5,
            'title' => 'parking',
            'image' => 'uploads/images/svg/parking.svg',
            'created_at' => Carbon::now(),
        ]); 
        $images->insert([
            'ranking' => 5,
            'page_id' => 1,
            'content_id' => 4,
            'lang_id' => 6,
            'title' => 'phone',
            'image' => 'uploads/images/svg/phone.svg',
            'created_at' => Carbon::now(),
        ]);  
    }
}
