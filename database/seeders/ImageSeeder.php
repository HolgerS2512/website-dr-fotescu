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
            'src' => 'uploads/images/home/home-slide.webp',
            'ext' => 'webp',
            'created_at' => Carbon::now(),
        ]); 
        $images->insert([
            'ranking' => 2,
            'page_id' => 1,
            'slide' => 1,
            'title' => 'home-slide-2',
            'src' => 'uploads/images/home/home-slide-2.webp',
            'ext' => 'webp',
            'created_at' => Carbon::now(),
        ]);
        $images->insert([
            'ranking' => 3,
            'page_id' => 1,
            'slide' => 1,
            'title' => 'home-slide-3',
            'src' => 'uploads/images/home/home-slide-3.webp',
            'ext' => 'webp',
            'created_at' => Carbon::now(),
        ]);

        // teamslider
        $images->insert([
            'ranking' => 1,
            'page_id' => 5,
            'slide' => 1,
            'title' => 'team-slide',
            'src' => 'uploads/images/team/team-slide.webp',
            'ext' => 'webp',
            'created_at' => Carbon::now(),
        ]); 
        $images->insert([
            'ranking' => 2,
            'page_id' => 5,
            'slide' => 1,
            'title' => 'team-slide-2',
            'src' => 'uploads/images/team/team-slide-2.webp',
            'ext' => 'webp',
            'created_at' => Carbon::now(),
        ]);
        $images->insert([
            'ranking' => 3,
            'page_id' => 5,
            'slide' => 1,
            'title' => 'team-slide-3',
            'src' => 'uploads/images/team/team-slide-3.webp',
            'ext' => 'webp',
            'created_at' => Carbon::now(),
        ]); 

        // cards svg
        $images->insert([
            'ranking' => 1,
            'page_id' => 1,
            'title' => 'calendar',
            'src' => 'uploads/svg/calendar.svg',
            'ext' => 'svg',
            'created_at' => Carbon::now(),
        ]); 
        $images->insert([
            'ranking' => 2,
            'page_id' => 1,
            'title' => 'wlan',
            'src' => 'uploads/svg/wlan.svg',
            'ext' => 'svg',
            'created_at' => Carbon::now(),
        ]); 
        $images->insert([
            'ranking' => 3,
            'page_id' => 1,
            'title' => 'wheelchair',
            'src' => 'uploads/svg/wheelchair.svg',
            'ext' => 'svg',
            'created_at' => Carbon::now(),
        ]); 
        $images->insert([
            'ranking' => 4,
            'page_id' => 1,
            'title' => 'parking',
            'src' => 'uploads/svg/parking.svg',
            'ext' => 'svg',
            'created_at' => Carbon::now(),
        ]); 
        $images->insert([
            'ranking' => 5,
            'page_id' => 1,
            'title' => 'phone',
            'src' => 'uploads/svg/phone.svg',
            'ext' => 'svg',
            'created_at' => Carbon::now(),
        ]);  

        // list item
        $images->insert([
            'page_id' => 1,
            'title' => 'blue checkbox',
            'src' => 'uploads/svg/checkbox.svg',
            'ext' => 'svg',
            'created_at' => Carbon::now(),
        ]);   

        // buttons
        $images->insert([
            'page_id' => 1,
            'ranking' => 1,
            'title' => 'emergency.format.button',
            'src' => 'uploads/images/button/emergency.format.button.webp',
            'ext' => 'webp',
            'created_at' => Carbon::now(),
        ]); 
        $images->insert([
            'page_id' => 1,
            'ranking' => 1,
            'title' => 'family.format.button',
            'src' => 'uploads/images/button/family.format.button.webp',
            'ext' => 'webp',
            'created_at' => Carbon::now(),
        ]); 
        $images->insert([
            'page_id' => 1,
            'ranking' => 1,
            'title' => 'prophylaxis.format.button',
            'src' => 'uploads/images/button/prophylaxis.format.button.webp',
            'ext' => 'webp',
            'created_at' => Carbon::now(),
        ]);  
        $images->insert([
            'page_id' => 1,
            'ranking' => 1,
            'title' => 'dentistry.format.button',
            'src' => 'uploads/images/button/dentistry.format.button.webp',
            'ext' => 'webp',
            'created_at' => Carbon::now(),
        ]);  
        $images->insert([
            'page_id' => 1,
            'ranking' => 1,
            'title' => 'periodontology.format.button',
            'src' => 'uploads/images/button/periodontology.format.button.webp',
            'ext' => 'webp',
            'created_at' => Carbon::now(),
        ]);  
        $images->insert([
            'page_id' => 1,
            'ranking' => 1,
            'title' => 'bleaching.format.button',
            'src' => 'uploads/images/button/bleaching.format.button.webp',
            'ext' => 'webp',
            'created_at' => Carbon::now(),
        ]);  
        $images->insert([
            'page_id' => 1,
            'ranking' => 1,
            'title' => 'restorative.format.button',
            'src' => 'uploads/images/button/restorative.format.button.webp',
            'ext' => 'webp',
            'created_at' => Carbon::now(),
        ]);  
        $images->insert([
            'page_id' => 1,
            'ranking' => 1,
            'title' => 'implants.format.button',
            'src' => 'uploads/images/button/implants.format.button.webp',
            'ext' => 'webp',
            'created_at' => Carbon::now(),
        ]);  
        $images->insert([
            'page_id' => 1,
            'ranking' => 1,
            'title' => 'dentures.format.button',
            'src' => 'uploads/images/button/dentures.format.button.webp',
            'ext' => 'webp',
            'created_at' => Carbon::now(),
        ]);    

        // team
        $images->insert([
            'page_id' => 2,
            'ranking' => 1,
            'title' => 'treatments',
            'src' => 'uploads/images/treatments/treatments.webp',
            'ext' => 'webp',
            'created_at' => Carbon::now(),
        ]); 

        // strip
        $images->insert([
            'page_id' => 2,
            'ranking' => 1,
            'title' => 'tooth',
            'src' => 'uploads/svg/tooth.svg',
            'ext' => 'svg',
            'created_at' => Carbon::now(),
        ]);  

        // contact
        $images->insert([
            'page_id' => 7,
            'ranking' => 1,
            'slide'=> 1,
            'title' => 'header',
            'src' => 'uploads/images/contact/header.webp',
            'ext' => 'webp',
            'created_at' => Carbon::now(),
        ]);   

        // transfer
        $images->insert([
            'page_id' => 6,
            'ranking' => 1,
            'slide'=> 1,
            'title' => 'transfer',
            'src' => 'uploads/images/transfer/transfer.webp',
            'ext' => 'webp',
            'created_at' => Carbon::now(),
        ]);
        $images->insert([
            'page_id' => 6,
            'ranking' => 1,
            'title' => 'pdf',
            'src' => 'uploads/svg/pdf.svg',
            'ext' => 'svg',
            'created_at' => Carbon::now(),
        ]); 

        // praxis_&_team
        $images->insert([
            'page_id' => 5,
            'ranking' => 1,
            'title' => 'example',
            'src' => 'uploads/images/team/example.webp',
            'ext' => 'webp',
            'created_at' => Carbon::now(),
        ]);  
        $images->insert([
            'page_id' => 5,
            'ranking' => 1,
            'title' => 'lemon-example',
            'src' => 'uploads/images/team/lemon-example.jpg',
            'ext' => 'jpg',
            'created_at' => Carbon::now(),
        ]);  
    }
}
