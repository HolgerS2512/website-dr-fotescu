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
        
        $content->insert([
            'ranking' => 1,
            'page_id' => 1,
            'format' => 'text',
            'created_at' => Carbon::now(),
        ]);
    }
}
