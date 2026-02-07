<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Office;

class OfficeSeeder extends Seeder
{
    public function run(): void
    {
        $offices = [
            [
                'city' => 'London',
                'country' => 'UK',
                'address' => '123 Oxford Street, London, W1D 1LP',
                'phone' => '+44 20 7123 4567',
                'email' => 'london@pioneers.edu',
                'type' => 'Headquarters',
                'slug' => 'london-office',
                'image' => '',
                'map_url' => '',
                'description' => 'Our main headquarters located in the heart of London.',
                'hours' => '9:00 AM - 5:00 PM (Mon-Fri)'
            ],
            [
                'city' => 'Dubai',
                'country' => 'UAE',
                'address' => 'Office 101, Business Bay, Dubai',
                'phone' => '+971 4 123 4567',
                'email' => 'dubai@pioneers.edu',
                'type' => 'Branch',
                'slug' => 'dubai-office',
                'image' => '',
                'map_url' => '',
                'description' => 'Serving students in the Middle East region.',
                'hours' => '9:00 AM - 6:00 PM (Sun-Thu)'
            ],
            [
                'city' => 'New Delhi',
                'country' => 'India',
                'address' => 'Connaught Place, New Delhi',
                'phone' => '+91 11 1234 5678',
                'email' => 'delhi@pioneers.edu',
                'type' => 'Branch',
                'slug' => 'delhi-office',
                'image' => '',
                'map_url' => '',
                'description' => 'Supporting students across India and South Asia.',
                'hours' => '10:00 AM - 6:00 PM (Mon-Sat)'
            ],
            [
                'city' => 'New York',
                'country' => 'USA',
                'address' => '5th Avenue, New York, NY',
                'phone' => '+1 212 123 4567',
                'email' => 'ny@pioneers.edu',
                'type' => 'Branch',
                'slug' => 'ny-office',
                'image' => '',
                'map_url' => '',
                'description' => 'Our hub for North American university admissions.',
                'hours' => '9:00 AM - 5:00 PM (Mon-Fri)'
            ]
        ];

        foreach ($offices as $office) {
            Office::updateOrCreate(['slug' => $office['slug']], $office);
        }
    }
}
