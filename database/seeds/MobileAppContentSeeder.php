<?php

use \Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MobileAppContentSeeder extends Seeder
{
    public function run(){
        $this->links();
    }

    public function links(){

        DB::table('mobile_app_content')->insert([
            ['name' => 'Blog', 'type' => 'url', 'key' => 'BLOG_YOUTUBE'],
            ['name' => 'Oficina virtual', 'type' => 'url', 'key' => 'VIRTUAL_OFFICE'],
            ['name' => 'Square', 'type' => 'url', 'key' => 'SQUARE'],
            ['name' => 'Plan de negocios', 'type' => 'pdf', 'key' => 'BUSINESS_PLAN'],
            ['name' => 'Catálogo', 'type' => 'pdf', 'key' => 'CATALOG'],
            ['name' => 'Kits', 'type' => 'pdf', 'key' => 'KITS'],
            ['name' => 'Tutorial', 'type' => 'pdf', 'key' => 'TUTORIAL'],
            ['name' => 'Facebook', 'type' => 'url', 'key' => 'FACEBOOK'],
            ['name' => 'Instagram', 'type' => 'url', 'key' => 'INSTAGRAM'],
            ['name' => 'WhatsApp', 'type' => 'url', 'key' => 'WHATSAPP'],
            ['name' => 'TikTok', 'type' => 'url', 'key' => 'TIKTOK'],
        ]);

    }

}
