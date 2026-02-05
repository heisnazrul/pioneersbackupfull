<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AccommodationRoom;

class AccommodationRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'title' => 'En-suite Room',
                'slug' => 'en-suite-room',
                'description' => 'Private bedroom and bathroom with a shared kitchen and living area.',
                'price' => 'From £150/week',
                'features' => ["Private Bath", "Shared Kitchen", "Study Desk"],
                'image' => '/assets/accommodation/ensuite.png',
                'details' => '<p>Enjoy your privacy with our En-suite rooms. You get your own private bathroom directly reachable from your bedroom, eliminating the need to wait in line. The kitchen and living areas are shared, creating a perfect balance between privacy and socialization.</p><ul><li>High-speed Wi-Fi</li><li>All utilities included</li><li>24/7 Security</li></ul>',
            ],
            [
                'title' => 'Studio Apartment',
                'slug' => 'studio-apartment',
                'description' => 'Entirely private space with your own kitchenette, bathroom, and living area.',
                'price' => 'From £220/week',
                'features' => ["Private Kitchen", "Private Bath", "More Space"],
                'image' => '/assets/accommodation/studio.png',
                'details' => '<p>For those who prefer complete independence, our Studio Apartments are the ideal choice. Featuring a private kitchenette, en-suite bathroom, and a larger living space, you have everything you need in one place.</p><ul><li>Private Kitchenette</li><li>Study Area</li><li>Smart TV</li></ul>',
            ],
            [
                'title' => 'Shared Apartment',
                'slug' => 'shared-apartment',
                'description' => 'Private bedroom with shared bathroom and kitchen facilities. Budget friendly.',
                'price' => 'From £110/week',
                'features' => ["Shared Bath", "Shared Kitchen", "Best Value"],
                'image' => '/assets/accommodation/shared.png',
                'details' => '<p>Our Shared Apartments offer the most affordable way to live near campus. You get a private bedroom for your studies and sleep, while sharing the bathroom and kitchen facilities with other students. It is a great way to make friends!</p><ul><li>Budget Friendly</li><li>Social Atmosphere</li><li>Regular Cleaning</li></ul>',
            ],
        ];

        foreach ($rooms as $room) {
            AccommodationRoom::updateOrCreate(['slug' => $room['slug']], $room);
        }
    }
}
