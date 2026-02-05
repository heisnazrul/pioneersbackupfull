<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CmsPage;

class AgentsPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $content = [
            'hero' => [
                'badge' => 'B2B Partnership Program',
                'title' => 'Grow Your Business with Pioneers',
                'description' => 'Join our global network of recruitment partners. We empower agents with the tools, technology, and university connections needed to succeed.',
                'cta_primary' => 'Become a Partner', // Kept for frontend usage if needed, but not in admin form
                'cta_primary_link' => '/contact',
                'cta_secondary' => 'Learn More',
                'cta_secondary_link' => '#benefits',
                'bg_image' => '/hero.png'
            ],
            'stats' => [ // Not in admin form, but needed for frontend.
                ['value' => '150+', 'label' => 'Global Universities'],
                ['value' => '10k+', 'label' => 'Students Placed'],
                ['value' => '50+', 'label' => 'Countries'],
                ['value' => '99%', 'label' => 'Visa Success'],
            ],
            'services_section' => [ // Renamed from 'benefits'
                'title' => 'Empowering Your Growth',
                'subtitle' => 'Why Choose Us',
                'description' => 'We provide everything you need to scale your student recruitment business efficiently.',
                'items' => [
                    [
                        'title' => 'Global Network',
                        'description' => 'Access our extensive network of 150+ top universities across the UK, USA, Canada, and Australia.',
                        'icon' => 'faGlobe'
                    ],
                    [
                        'title' => 'High Commissions',
                        'description' => 'Earn competitive commissions with timely payouts and transparent tracking systems.',
                        'icon' => 'faPercent'
                    ],
                    [
                        'title' => 'Marketing Support',
                        'description' => 'Get access to branded marketing materials, brochures, and digital assets to attract more students.',
                        'icon' => 'faChartLine'
                    ],
                    [
                        'title' => 'Dedicated Account Manager',
                        'description' => 'Work with a dedicated expert who will guide you through admissions and updates.',
                        'icon' => 'faUserGroup'
                    ],
                    [
                        'title' => 'Priority Training',
                        'description' => 'Regular training sessions on university courses, visa updates, and application processes.',
                        'icon' => 'faCheckCircle'
                    ],
                    [
                        'title' => '24/7 Support',
                        'description' => 'Our support team is always available to resolve queries and assist with urgent applications.',
                        'icon' => 'faHeadset'
                    ]
                ]
            ],
            'process_section' => [ // Renamed from 'steps'
                'title' => 'Simple Steps to Start',
                'description' => 'Partnership Process', // Mapped subtitle to description or vice versa based on form usage
                'steps' => [
                    ['number' => '01', 'title' => 'Register', 'description' => 'Fill out our partner registration form with your business details.'],
                    ['number' => '02', 'title' => 'Verify', 'description' => 'Our team will review your application and conduct a quick validation call.'],
                    ['number' => '03', 'title' => 'Start Recruiting', 'description' => 'Get access to our portal and start submitting student applications.']
                ]
            ],
            'cta_section' => [
                'title' => 'Ready to grow with us?',
                'button_text' => 'Register as a Partner Now',
                'description' => 'Join over 500+ active agents today.'
            ]
        ];

        CmsPage::updateOrCreate(
            ['slug' => 'visa-support'], // User specifically requested this slug path
            [
                'title' => 'Agents & Partners',
                'sub_title' => 'Grow with Pioneers',
                'meta_title' => 'Become a Partner Agent | Pioneers Admissions',
                'meta_description' => 'Join our global network of recruitment partners and grow your business.',
                'content' => $content, // Automatically cast to JSON
                'is_active' => true,
            ]
        );
    }
}
