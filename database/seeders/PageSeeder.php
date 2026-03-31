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
                'content' => '<h2>Welcome to Alley Homestay - Ha Giang Loop</h2><p>Discover the beauty of Ha Giang with our quality tours...</p>',
                'meta_title' => 'About Us - Alley Homestay - Ha Giang Loop',
                'meta_description' => 'Learn more about Alley Homestay - Ha Giang Loop and our mission to provide quality travel experiences.',
                'is_active' => true,
            ]
        );
    }
}

