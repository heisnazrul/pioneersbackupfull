<?php

namespace Database\Seeders;

use App\Models\Certification;
use Illuminate\Database\Seeder;

class CertificationSeeder extends Seeder
{
    public function run(): void
    {
        $certs = [
            'British Council Agent',
            'ICEF Agent',
            'AIRC Certified',
            'English UK Partner',
            'UCAS Registered Centre',
            'PIER Qualified',
            'CCEA Approved',
            'NAFSA Member',
            'EAIE Member',
            'Quality Education Agent'
        ];

        foreach ($certs as $title) {
            Certification::firstOrCreate(
                ['title' => $title],
                [
                    'subtitle' => 'Global Recognition',
                    'certification_link' => 'https://example.com',
                ]
            );
        }
    }
}
