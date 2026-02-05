<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CmsPage;

class ServicesCmsPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Services Page
        CmsPage::updateOrCreate(
            ['slug' => 'services'],
            [
                'title' => 'Our Services',
                'sub_title' => 'What We Offer',
                'meta_title' => 'Services | Pioneers Admissions',
                'meta_description' => 'Explore the wide range of services we offer to help you study abroad.',
                'content' => [
                    'hero' => [
                        'badge' => 'Our Expertise',
                        'title' => 'World-Class Services',
                        'description' => 'We provide end-to-end support for your study abroad journey, from university selection to visa approval.'
                    ],
                    'what_we_offer' => [
                        'title' => 'What We Offer',
                        'description' => 'Comprehensive solutions for every step of your journey.',
                        'items' => [
                            [
                                'title' => 'University Admissions',
                                'description' => 'Guidance on selecting and applying to top universities worldwide.',
                                'icon' => 'faUniversity'
                            ],
                            [
                                'title' => 'Visa Assistance',
                                'description' => 'Expert support for student visa applications and interviews.',
                                'icon' => 'faPassport'
                            ],
                            [
                                'title' => 'Scholarship Support',
                                'description' => 'Help finding and applying for financial aid and scholarships.',
                                'icon' => 'faGraduationCap'
                            ],
                            [
                                'title' => 'Travel & Accommodation',
                                'description' => 'Assistance with flight bookings and finding secure student housing.',
                                'icon' => 'faPlane'
                            ]
                        ]
                    ],
                    'our_process' => [
                        'title' => 'How It Works',
                        'steps' => [
                            ['number' => '01', 'title' => 'Consultation', 'description' => 'Free initial counseling to understand your goals.'],
                            ['number' => '02', 'title' => 'Application', 'description' => 'We help you prepare and submit your applications.'],
                            ['number' => '03', 'title' => 'Visa', 'description' => 'Guidance through the visa documentation process.'],
                            ['number' => '04', 'title' => 'Departure', 'description' => 'Pre-departure briefing and travel arrangements.']
                        ]
                    ],
                    'cta' => [
                        'title' => 'Ready to Start?',
                        'description' => 'Book your free consultation today and take the first step towards your dream.',
                        'button_text' => 'Book Consultation',
                        'button_link' => '/contact'
                    ]
                ]
            ]
        );

        // 2. Applications Page
        CmsPage::updateOrCreate(
            ['slug' => 'applications'],
            [
                'title' => 'Applications',
                'sub_title' => 'Application Process',
                'content' => [
                    'hero' => [
                        'badge' => 'Apply Now',
                        'title' => 'Start Your Application',
                        'description' => 'Your journey to a top university starts here. We guide you through every step.'
                    ],
                    'requirements' => [
                        'title' => 'Admission Requirements',
                        'items' => [
                            ['title' => 'Academic Transcripts', 'description' => 'High school or university records.'],
                            ['title' => 'Language Profits', 'description' => 'IELTS, TOEFL, or PTE scores.'],
                            ['title' => 'Passport Copy', 'description' => 'Valid passport for travel.'],
                            ['title' => 'Statement of Purpose', 'description' => 'A personal essay explaining your goals.']
                        ]
                    ],
                    'process_steps' => [
                        'title' => 'Application Timeline',
                        'steps' => [
                            ['number' => '1', 'title' => 'Document Check', 'description' => 'We verify all your documents.'],
                            ['number' => '2', 'title' => 'Submission', 'description' => 'We submit to universities on your behalf.'],
                            ['number' => '3', 'title' => 'Offer Letter', 'description' => 'Receive conditional or unconditional offers.']
                        ]
                    ],
                    'cta' => [
                        'title' => 'Apply Online',
                        'description' => 'You can start your application process directly through our portal.',
                        'button_text' => 'Apply Now',
                        'button_link' => '/portal/apply'
                    ]
                ]
            ]
        );

        // 3. Agents Page
        CmsPage::updateOrCreate(
            ['slug' => 'agents'],
            [
                'title' => 'Agent Program',
                'sub_title' => 'Partner With Us',
                'content' => [
                    'hero' => [
                        'badge' => 'Partnership',
                        'title' => 'Become a Pioneers Agent',
                        'description' => 'Join our global network of authorized representatives and grow your business.'
                    ],
                    'benefits' => [
                        'title' => 'Why Partner With Us?',
                        'items' => [
                            ['title' => 'High Commissions', 'description' => 'Competitive commission structures.'],
                            ['title' => 'Global Network', 'description' => 'Access to 500+ universities.'],
                            ['title' => 'Marketing Support', 'description' => 'Promotional materials and training.'],
                            ['title' => 'Dedicated Support', 'description' => '24/7 assistance from our agent team.']
                        ]
                    ],
                    'how_to_join' => [
                        'title' => 'Joining Process',
                        'steps' => [
                            ['number' => '01', 'title' => 'Register', 'description' => 'Fill out the agent registration form.'],
                            ['number' => '02', 'title' => 'Verification', 'description' => 'We review your business credentials.'],
                            ['number' => '03', 'title' => 'Agreement', 'description' => 'Sign the partnership agreement.'],
                            ['number' => '04', 'title' => 'Onboarding', 'description' => 'Receive training and portal access.']
                        ]
                    ],
                    'cta' => [
                        'title' => 'Become a Partner',
                        'description' => 'Join us today and expand your opportunities.',
                        'button_text' => 'Register as Agent',
                        'button_link' => '/agents/register'
                    ]
                ]
            ]
        );

        // 4. Accommodation Page
        CmsPage::updateOrCreate(
            ['slug' => 'accommodation'],
            [
                'title' => 'Student Accommodation',
                'sub_title' => 'Find Your Home',
                'content' => [
                    'hero' => [
                        'badge' => 'Housing',
                        'title' => 'Find Your Perfect Home',
                        'description' => 'Browse our verified student accommodation options. Safe, comfortable, and affordable.'
                    ],
                    'why_choose_us' => [
                        'title' => 'Why Our Housing?',
                        'items' => [
                            ['title' => 'Verified Listings', 'description' => 'All properties are personally checked.'],
                            ['title' => 'No Hidden Fees', 'description' => 'Transparent pricing policies.'],
                            ['title' => 'Student Centric', 'description' => 'Locations near universities and transit.'],
                            ['title' => '24/7 Support', 'description' => 'Assistance whenever you need it.']
                        ]
                    ],
                    'booking_process' => [
                        'title' => 'Easy Booking',
                        'steps' => [
                            ['number' => '1', 'title' => 'Search', 'description' => 'Filter by city and university.'],
                            ['number' => '2', 'title' => 'Select', 'description' => 'Choose your preferred room type.'],
                            ['number' => '3', 'title' => 'Reserve', 'description' => 'Pay a deposit to secure your room.']
                        ]
                    ],
                    'cta' => [
                        'title' => 'Need Help?',
                        'description' => 'Our accommodation team can help you find the right place.',
                        'button_text' => 'Contact Housing Team',
                        'button_link' => '/contact'
                    ]
                ]
            ]
        );
    }
}
