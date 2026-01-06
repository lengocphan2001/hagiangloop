<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create About page
        Page::firstOrCreate(
            ['slug' => 'about'],
            [
                'title' => 'About Us',
                'content' => '<h2>Welcome to Ha Giang Loop Tours</h2><p>Discover the beauty of Ha Giang with our quality tours...</p>',
                'meta_title' => 'About Us - Ha Giang Loop Tours',
                'meta_description' => 'Learn more about Ha Giang Loop Tours and our mission to provide quality travel experiences.',
                'is_active' => true,
            ]
        );
    }
}

