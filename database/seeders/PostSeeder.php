<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = DB::table('posts');
        
        $content->insert([
            'ranking' => 1,
            'user_id' => 1,
            'public' => 1,
            'de' => 'Lorem, ipsum dolor sit amet consectetur adipisicing',
            'content_id' => 22,
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'ranking' => 2,
            'user_id' => 1,
            'public' => 1,
            'de' => 'Lorem, ipsum dolor sit Reprehenderit animi provident',
            'content_id' => 23,
            'created_at' => Carbon::now(),
        ]);
        $content->insert([
            'ranking' => 3,
            'user_id' => 1,
            'public' => 1,
            'de' => 'Lorem, ipsum dolor sit amet dolor sit amet',
            'content_id' => 24,
            'created_at' => Carbon::now(),
        ]);
    }
}
