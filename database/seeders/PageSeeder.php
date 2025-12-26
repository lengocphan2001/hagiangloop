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
                'content' => '<h2>Welcome to Hà Giang Loop Tours</h2><p>Discover the beauty of Hà Giang with our quality tours...</p>',
                'meta_title' => 'About Us - Hà Giang Loop Tours',
                'meta_description' => 'Learn more about Hà Giang Loop Tours and our mission to provide quality travel experiences.',
                'is_active' => true,
            ]
        );
    }
}

