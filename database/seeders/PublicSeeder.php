<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $publish = DB::table('publishes');
        
        $publish->insert([
            'page_id' => 1,
            'name' => 'home.slider',
            'public' => '1',
        ]);

        $publish->insert([
            'page_id' => 2,
            'name' => 'treatments.slider',
            'public' => '0',
        ]);

        $publish->insert([
            'page_id' => 3,
            'name' => 'blog.slider',
            'public' => '0',
        ]);

        $publish->insert([
            'page_id' => 4,
            'name' => 'cost.slider',
            'public' => '0',
        ]);

        $publish->insert([
            'page_id' => 5,
            'name' => 'team.slider',
            'public' => '0',
        ]);

        $publish->insert([
            'page_id' => 6,
            'name' => 'transfer.slider',
            'public' => '0',
        ]);

        $publish->insert([
            'page_id' => 7,
            'name' => 'contact.slider',
            'public' => '0',
        ]);

        $publish->insert([
            'page_id' => 8,
            'name' => 'privacy.slider',
            'public' => '0',
        ]);

        $publish->insert([
            'page_id' => 9,
            'name' => 'imprint.slider',
            'public' => '0',
        ]);

        $publish->insert([
            'page_id' => 2,
            'subpage_id' => 1,
            'name' => 'emergency.slider',
            'public' => '0',
        ]);

        $publish->insert([
            'page_id' => 2,
            'subpage_id' => 2,
            'name' => 'family.slider',
            'public' => '0',
        ]);

        $publish->insert([
            'page_id' => 2,
            'subpage_id' => 3,
            'name' => 'prophylaxis.slider',
            'public' => '0',
        ]);

        $publish->insert([
            'page_id' => 2,
            'subpage_id' => 4,
            'name' => 'dentistry.slider',
            'public' => '0',
        ]);

        $publish->insert([
            'page_id' => 2,
            'subpage_id' => 5,
            'name' => 'periodontology.slider',
            'public' => '0',
        ]);

        $publish->insert([
            'page_id' => 2,
            'subpage_id' => 6,
            'name' => 'bleaching.slider',
            'public' => '0',
        ]);

        $publish->insert([
            'page_id' => 2,
            'subpage_id' => 7,
            'name' => 'restorative.slider',
            'public' => '0',
        ]);

        $publish->insert([
            'page_id' => 2,
            'subpage_id' => 8,
            'name' => 'implants.slider',
            'public' => '0',
        ]);

        $publish->insert([
            'page_id' => 2,
            'subpage_id' => 9,
            'name' => 'dentures.slider',
            'public' => '0',
        ]);

        $publish->insert([
            'page_id' => 7,
            'name' => 'contact_collection.form',
            'public' => '1',
        ]);
    }
}
