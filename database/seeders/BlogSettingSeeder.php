<?php

namespace Database\Seeders;

use App\Models\BlogSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BlogSetting::create([
            'default_post_image' => 'default_post_image.png'
        ]);
    }
}
