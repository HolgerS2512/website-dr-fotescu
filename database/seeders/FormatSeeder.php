<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class FormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $f = DB::table('format');

        $f->insert([
            'name' => 'text',
            'blueprint' => 'title.content',
            'created_at' => Carbon::now(),
        ]);
        
        $f->insert([
            'name' => 'buttons',
            'blueprint' => 'words.subpage',
            'created_at' => Carbon::now(),
        ]);
        
        $f->insert([
            'name' => 'strip',
            'blueprint' => 'img.list:5',
            'created_at' => Carbon::now(),
        ]);
        
        $f->insert([
            'name' => 'cards',
            'blueprint' => 'cards',
            'created_at' => Carbon::now(),
        ]);
        
        $f->insert([
            'name' => 'has_subpages',
            'blueprint' => 'subpages',
            'created_at' => Carbon::now(),
        ]);
        
        $f->insert([
            'name' => 'headline_list',
            'blueprint' => 'title.list:20.svglist',
            'created_at' => Carbon::now(),
        ]);
        
        $f->insert([
            'name' => 'headline_text',
            'blueprint' => 'title.content',
            'created_at' => Carbon::now(),
        ]);
        
        $f->insert([
            'name' => 'image_overlap',
            'blueprint' => 'img.pagelist.words.title.content.img',
            'created_at' => Carbon::now(),
        ]);
        
        $f->insert([
            'name' => 'x_link',
            'blueprint' => 'pagelist.words.title.content',
            'created_at' => Carbon::now(),
        ]);
        
        $f->insert([
            'name' => 'details',
            'blueprint' => 'title.content',
            'created_at' => Carbon::now(),
        ]);
        
        $f->insert([
            'name' => 'download',
            'blueprint' => 'img.btn.url_link',
            'created_at' => Carbon::now(),
        ]);
        
        $f->insert([
            'name' => 'contact_collection',
            'blueprint' => 'details',
            'created_at' => Carbon::now(),
        ]);
        
        $f->insert([
            'name' => 'cross_list',
            'blueprint' => 'title.content.list',
            'created_at' => Carbon::now(),
        ]);
        
        $f->insert([
            'name' => 'map',
            'blueprint' => 'title.url_link',
            'created_at' => Carbon::now(),
        ]);
        
        $f->insert([
            'name' => 'headline_image',
            'blueprint' => 'img.title.content',
            'created_at' => Carbon::now(),
        ]);
        
        $f->insert([
            'name' => 'image_solo',
            'blueprint' => 'img',
            'created_at' => Carbon::now(),
        ]);
        
        $f->insert([
            'name' => 'subheading',
            'blueprint' => 'title.list:5',
            'created_at' => Carbon::now(),
        ]);
        
        $f->insert([
            'name' => 'blog_posts',
            'blueprint' => 'posts',
            'created_at' => Carbon::now(),
        ]); 
    }
}
