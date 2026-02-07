<?php

namespace Database\Seeders;

use App\Models\UniversityCampus;
use App\Models\University;
use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UniversityCampusSeeder extends Seeder
{
    public function run(): void
    {
        $uni = University::first();
        $city = City::first();

        if (!$uni || !$city)
            return;

        $campuses = ['Main Campus', 'North Campus', 'City Center Campus', 'Riverside Campus', 'Tech Park Campus', 'Medical Campus', 'Business School Hub', 'Historic Campus', 'South Campus', 'East Campus'];

        foreach ($campuses as $name) {
            UniversityCampus::firstOrCreate(
                ['university_id' => $uni->id, 'name' => $name],
                [
                    'slug' => Str::slug($name),
                    'city_id' => $city->id,
                    'address' => '123 University Way',
                    'is_active' => true,
                ]
            );
        }
    }
}
