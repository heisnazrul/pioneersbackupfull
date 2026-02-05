<?php

namespace Database\Seeders;

use App\Models\CmsPage;
use Illuminate\Database\Seeder;

class ServicesPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $content = [
            'hero' => [
                'badge' => 'World-Class Support',
                'title' => 'Comprehensive Services for Your Global Journey.',
                'description' => 'From your first counseling session to your first day on campus, we provide the tools, guidance, and support you need to succeed.',
                'button_text' => 'Book Consultation',
                'button_link' => '/consultation',
                'secondary_button_text' => 'Contact Us',
                'secondary_button_link' => '/contact',
            ],
            'what_we_offer' => [
                'title' => 'What We Offer',
                'description' => 'Tailored solutions designed to make your study abroad experience seamless and stress-free.',
                'items' => [
                    [
                        'title' => 'University Admissions',
                        'description' => 'Expert guidance on selecting courses and universities that align with your career goals. We handle the entire application process.',
                        'icon' => 'faUniversity',
                        'link' => '/services/application',
                    ],
                    [
                        'title' => 'Visa Assistance',
                        'description' => 'Comprehensive support for student visa applications, including document checklists, interview preparation, and filing.',
                        'icon' => 'faPassport',
                        'link' => '/services/visa',
                    ],
                    [
                        'title' => 'Accommodation',
                        'description' => 'Find your home away from home. We help you book safe and affordable student housing near your university.',
                        'icon' => 'faHome',
                        'link' => '/services/accommodation',
                    ],
                    [
                        'title' => 'Scholarships',
                        'description' => 'Discover funding opportunities. We track thousands of scholarships to help you finance your education.',
                        'icon' => 'faGraduationCap',
                        'link' => '/scholarships',
                    ],
                    [
                        'title' => 'Partner Network',
                        'description' => 'For agents and institutions. Join our global network to expand your reach and help more students succeed.',
                        'icon' => 'faHandshake',
                        'link' => '/services/agents',
                    ],
                    [
                        'title' => 'Student Guides',
                        'description' => 'Essential resources, checklists, and how-to guides for every step of your study abroad journey.',
                        'icon' => 'faBookOpen',
                        'link' => '/services/guides',
                    ],
                ],
            ],
            'our_process' => [
                'title' => 'Simple Steps to Success',
                'description' => "We've simplified the complex study abroad process into a clear, manageable roadmap. Our experts are with you at every milestone.",
                'steps' => [
                    [
                        'number' => '01',
                        'title' => 'Profile Evaluation',
                        'description' => 'We analyze your academic background and career goals.',
                    ],
                    [
                        'number' => '02',
                        'title' => 'University Selection',
                        'description' => 'Curated list of universities that match your profile.',
                    ],
                    [
                        'number' => '03',
                        'title' => 'Application & Visa',
                        'description' => 'End-to-end support with documentation and filing.',
                    ],
                    [
                        'number' => '04',
                        'title' => 'Pre-Departure',
                        'description' => 'Accommodation, flights, and briefing for your new life.',
                    ],
                ]
            ],
            'partner_section' => [
                'badge' => 'For Partners',
                'title' => 'Grow with Pioneers Admissions',
                'description' => 'Are you an education agent or institution? Join our global network to access exclusive resources, streamlined processing, and dedicated support to help your students succeed.',
                'button_text' => 'Become a Partner',
                'button_link' => '/services/agents',
                'secondary_button_text' => 'Contact Our B2B Team',
                'secondary_button_link' => '/contact',
            ],
            'cta' => [
                'title' => 'Ready to start your journey?',
                'description' => 'Book a free consultation with our experts today and take the first step towards your global education.',
                'button_text' => 'Get Started Now',
                'button_link' => '/consultation', // Assuming this based on context, adjusted from 'Get Started Now' which usually implies a link
            ]
        ];

        CmsPage::updateOrCreate(
            ['slug' => 'services'],
            [
                'title' => 'Our Services',
                'sub_title' => 'World-Class Support for Your Global Journey',
                'content' => $content,
            ]
        );
    }
}
