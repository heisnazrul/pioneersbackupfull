<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmsPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // About Us Page Seeder
        \App\Models\CmsPage::updateOrCreate(
            ['slug' => 'about'],
            [
                'title' => 'About Pioneers',
                'sub_title' => 'Transforming lives through international education since 2012.',
                'meta_title' => 'About Us | Pioneers Admissions',
                'meta_description' => 'Welcome to Pioneers Educational Admission Consultancy. We guide students to prestigious institutions worldwide.',
                'content' => [
                    'hero' => [
                        'badge' => 'Who We Are',
                        'title' => 'About Pioneers',
                        'description' => 'Transforming lives through international education since 2012.'
                    ],
                    'director_message' => [
                        'image' => 'https://placehold.co/600x800?text=Director',
                        'name' => 'Md Abdul Qaium',
                        'role' => 'Director',
                        'title' => 'Welcome to Pioneers EDU',
                        'paragraphs' => [
                            'Dear Valued Partners, Students, and Stakeholders,',
                            'Welcome to Pioneers Educational Admission Consultancy (PEAC). From humble beginnings, we have grown into a global organization dedicated to transforming lives through international education. With offices across multiple countries, we guide students to prestigious institutions worldwide, ensuring their success and satisfaction.',
                            'Our team of highly experienced representatives, educated at renowned universities, provides expert, culturally sensitive guidance. This unique blend of expertise and empathy sets us apart.',
                            'We are proud of our high visa success rates and the trust placed in us by students and partners. Our commitment to innovation and personalized support continues to drive our growth and impact.'
                        ],
                        'closing' => [
                            'text' => 'Warm regards,',
                            'name' => 'Md Abdul Qaium',
                            'position' => 'Director, Pioneers Educational Admission Consultancy Ltd'
                        ]
                    ],
                    'ceo_message' => [
                        'image' => 'https://placehold.co/600x800?text=CEO',
                        'name' => 'Hanan Asiri',
                        'role' => 'CEO',
                        'title' => 'A Message from the CEO',
                        'paragraphs' => [
                            'Dear Students, Parents, and Collaborators,',
                            'As CEO of Pioneers Edu, I am honored to oversee an organization that prioritizes educational excellence and student success. Our mission is to empower students by providing access to world-class education and resources that shape their futures.',
                            'At Pioneers EDU, we believe in creating opportunities through innovation, collaboration, and integrity. With our global reach and experienced team, we have successfully guided thousands of students toward achieving their academic dreams.',
                            'Thank you for trusting us to be part of your journey. Together, we will continue to break barriers and build brighter futures for generations to come.'
                        ],
                        'closing' => [
                            'text' => 'Warm regards,',
                            'name' => 'Hanan Asiri',
                            'position' => 'CEO, Pioneers Educational Admission Consultancy Ltd'
                        ]
                    ],
                    'team' => [
                        'badge' => 'Our Experts',
                        'title' => 'Meet Our Team',
                        'members' => [
                            [
                                'name' => "Tasnim Zarin",
                                'role' => "Admission Consultation Leader",
                                'desc' => "Guiding and managing admissions to ensure a smooth enrollment process.",
                                'image' => "https://placehold.co/400x500?text=Tasnim"
                            ],
                            [
                                'name' => "Umme Habiba",
                                'role' => "Sales Manager",
                                'desc' => "Driving sales growth and leading teams to achieve business targets.",
                                'image' => "https://placehold.co/400x500?text=Umme"
                            ],
                            [
                                'name' => "Nazrul Islam",
                                'role' => "System Administrator",
                                'desc' => "Managing and securing IT systems to ensure seamless operations.",
                                'image' => "https://placehold.co/400x500?text=Nazrul"
                            ],
                            [
                                'name' => "Shohidul Hasan Mitu",
                                'role' => "BD Office Manager",
                                'desc' => "Overseeing operations and ensuring efficiency in BD office management.",
                                'image' => "https://placehold.co/400x500?text=Shohidul"
                            ]
                        ]
                    ]
                ]
            ]
        );

        // Contact Us Page Seeder
        \App\Models\CmsPage::updateOrCreate(
            ['slug' => 'contact'],
            [
                'title' => 'Contact Us',
                'sub_title' => 'Get in touch with our team.',
                'meta_title' => 'Contact Us | Pioneers Admissions',
                'meta_description' => 'Get in touch with our team. Visit our offices in London, Dubai, Delhi, and New York.',
                'content' => [
                    'hero' => [
                        'badge' => "We're Here for You",
                        'title' => 'Contact Us',
                        'description' => "Whether you have a question about universities, visas, or just want to say hello, we're ready to answer all your questions."
                    ],
                    'contact_info' => [
                        'email' => 'info@pioneers.edu.sa',
                        'phone' => '+966 50 123 4567',
                        'description' => "Can't make it to an office? No problem. Fill out the form or reach out to us directly through our general channels.",
                        'social_links' => [
                            ['platform' => 'Facebook', 'url' => '#'],
                            ['platform' => 'Twitter', 'url' => '#'],
                            ['platform' => 'Instagram', 'url' => '#'],
                            ['platform' => 'LinkedIn', 'url' => '#']
                        ]
                    ],
                    'offices' => [
                        [
                            'id' => 1,
                            'city' => 'London',
                            'country' => 'UK',
                            'address' => '123 Oxford Street, London, W1D 1LP',
                            'phone' => '+44 20 7123 4567',
                            'email' => 'london@pioneers.edu',
                            'type' => 'Headquarters',
                            'slug' => 'london-office',
                            'image' => ''
                        ],
                        [
                            'id' => 2,
                            'city' => 'Dubai',
                            'country' => 'UAE',
                            'address' => 'Office 101, Business Bay, Dubai',
                            'phone' => '+971 4 123 4567',
                            'email' => 'dubai@pioneers.edu',
                            'type' => 'Branch',
                            'slug' => 'dubai-office',
                            'image' => ''
                        ],
                        [
                            'id' => 3,
                            'city' => 'New Delhi',
                            'country' => 'India',
                            'address' => 'Connaught Place, New Delhi',
                            'phone' => '+91 11 1234 5678',
                            'email' => 'delhi@pioneers.edu',
                            'type' => 'Branch',
                            'slug' => 'delhi-office',
                            'image' => ''
                        ],
                        [
                            'id' => 4,
                            'city' => 'New York',
                            'country' => 'USA',
                            'address' => '5th Avenue, New York, NY',
                            'phone' => '+1 212 123 4567',
                            'email' => 'ny@pioneers.edu',
                            'type' => 'Branch',
                            'slug' => 'ny-office',
                            'image' => ''
                        ]
                    ]
                ]
            ]
        );

        // Student Guide Page Seeder
        \App\Models\CmsPage::updateOrCreate(
            ['slug' => 'student-guide'],
            [
                'title' => 'Student Guide',
                'sub_title' => 'Essential Student Guides',
                'meta_title' => 'Student Guide | Pioneers Admissions',
                'meta_description' => 'Expert advice and comprehensive resources for your international education journey.',
                'content' => [
                    'hero' => [
                        'badge' => 'Knowledge Hub',
                        'title' => 'Essential Student Guides',
                        'description' => 'Expert advice, insider tips, and comprehensive resources to help you thrive in your international education journey.'
                    ],
                    'categories' => [
                        [
                            'title' => "Pre-Departure",
                            'description' => "Packing lists, flight tips, and essential checklists before you leave home.",
                            'icon' => "faPlane",
                            'color' => "bg-blue-50 text-blue-600"
                        ],
                        [
                            'title' => "Academic Success",
                            'description' => "Study tips, understanding grading systems, and how to ace your assignments.",
                            'icon' => "faGraduationCap",
                            'color' => "bg-green-50 text-green-600"
                        ],
                        [
                            'title' => "Cost of Living",
                            'description' => "Budgeting advice, part-time work rules, and banking guides for students.",
                            'icon' => "faMoneyBillWave",
                            'color' => "bg-orange-50 text-orange-600"
                        ],
                        [
                            'title' => "City Guides",
                            'description' => "Deep dives into student life in London, New York, Toronto, and more.",
                            'icon' => "faCity",
                            'color' => "bg-purple-50 text-purple-600"
                        ]
                    ],
                    'trust_section' => [
                        'title' => 'Trusted by 10,000+ Students',
                        'description' => 'Our guides are written by experienced education counselors and alumni who have been through the process themselves. We ensure every piece of advice is accurate, up-to-date, and actionable.',
                        'cta_text' => 'Speak to an Expert',
                        'cta_link' => '/contact'
                    ],
                    'tools_resources' => [
                        'title' => 'Tools & Resources',
                        'subtitle' => 'Free Downloads',
                        'description' => 'Essential templates and checklists to simplify your application process.',
                        'items' => [] // Now powered by Destination Guides API
                    ],
                    'faq' => [
                        'title' => 'Frequently Asked Questions',
                        'subtitle' => 'Common Questions',
                        'description' => 'Have questions? We have answers. If you can\'t find what you\'re looking for, feel free to contact our expert team.',
                        'cta' => [
                            'title' => 'Still have questions?',
                            'description' => 'Our counselors are ready to help you with your specific study abroad queries.',
                            'btn_text' => 'Contact Us',
                            'btn_link' => '/contact'
                        ],
                        'items' => [
                            [
                                'question' => 'How long does the study abroad application process take?',
                                'answer' => 'Typically, it takes 6-12 months. This includes researching universities, preparing for standardized tests (IELTS/TOEFL), gathering documents, applying for admission, and finally the visa process. We recommend starting at least a year in advance.'
                            ],
                            [
                                'question' => 'Can I work while studying abroad?',
                                'answer' => 'Yes, most countries allow international students to work part-time (usually 20 hours per week) during term time and full-time during breaks. Countries like the UK, Canada, Australia, and Germany have specific regulations that we can guide you through.'
                            ],
                            [
                                'question' => 'What are the English language requirements?',
                                'answer' => 'Requirements vary by country and university. Generally, a minimum IELTS score of 6.0-6.5 or a TOEFL iBT score of 80-90 is required for undergraduate and postgraduate courses. Some universities may offer waivers based on your academic background.'
                            ],
                            [
                                'question' => 'Are scholarship opportunities available for international students?',
                                'answer' => 'Absolutely! There are merit-based, need-based, and country-specific scholarships available. We help you identify and apply for scholarships that match your profile to reduce your financial burden.'
                            ],
                            [
                                'question' => 'Do you help with student accommodation?',
                                'answer' => 'Yes, we assist with finding suitable accommodation, whether it\'s on-campus university housing or private off-campus apartments. Check out our Accommodation section for options.'
                            ]
                        ]
                    ],
                    'featured_guides_category_slug' => 'visa'
                ]
            ]
        );

        // Visa Support Page Seeder
        \App\Models\CmsPage::updateOrCreate(
            ['slug' => 'visa-support'],
            [
                'title' => 'Visa Support',
                'sub_title' => 'Secure Your Student Visa',
                'meta_title' => 'Visa Support | Pioneers Admissions',
                'meta_description' => 'Expert guidance for UK, USA, Canada, and Australia student visas.',
                'content' => [
                    'hero' => [
                        'badge' => 'Visa Support Services',
                        'title' => 'Secure Your Student Visa',
                        'description' => 'Expert guidance for UK, USA, Canada, and Australia student visas. We minimize the risk of rejection with our proven methodology.'
                    ],
                    'services_section' => [
                        'title' => 'Comprehensive Visa Support',
                        'subtitle' => 'Detailed Assistance',
                        'description' => 'From document checklist to interview preparation, we cover every aspect of your application.',
                        'items' => [
                            [
                                'title' => "Document Verification",
                                'description' => "Reviewing your financial proofs, academic records, and sponsorship letters to meet embassy standards.",
                                'icon' => "faCheckDouble"
                            ],
                            [
                                'title' => "Mock Interviews",
                                'description' => "One-on-one sessions simulating real visa interviews to boost your confidence and readiness.",
                                'icon' => "faUserTie"
                            ],
                            [
                                'title' => "Application Strategy",
                                'description' => "Structuring your application to highlight your strong ties to your home country and genuine intent to study.",
                                'icon' => "faScaleBalanced"
                            ],
                            [
                                'title' => "Financial Guidance",
                                'description' => "Expert advice on presenting funds, sponsorships, and scholarships correctly.",
                                'icon' => "faFileShield"
                            ],
                            [
                                'title' => "Slot Booking",
                                'description' => "Assistance with booking biometric and interview slots at the earliest availability.",
                                'icon' => "faTimeline"
                            ],
                            [
                                'title' => "Post-Visa Support",
                                'description' => "Pre-departure briefings and guidance on travel insurance and accommodation.",
                                'icon' => "faPlaneDeparture"
                            ]
                        ]
                    ],
                    'process_section' => [
                        'title' => 'Your Roadmap to Approval',
                        'subtitle' => 'Step-by-Step',
                        'description' => 'A clear, structured timeline to ensure zero errors and maximum preparedness.',
                        'steps' => [
                            [
                                'number' => "01",
                                'title' => "Consultation",
                                'description' => "We assess your profile and funding to determine the best visa strategy."
                            ],
                            [
                                'number' => "02",
                                'title' => "Documentation",
                                'description' => "Collecting and organizing every required document flawlessly."
                            ],
                            [
                                'number' => "03",
                                'title' => "Application",
                                'description' => "Filling out visa forms (DS-160, etc.) with precision."
                            ],
                            [
                                'number' => "04",
                                'title' => "Interview Prep",
                                'description' => "Intensive training for your embassy interview."
                            ]
                        ]
                    ],
                    'cta_section' => [
                        'title' => "Don't Risk Your Visa Application",
                        'description' => "Get it right the first time with our expert guidance. Book a consultation today.",
                        'button_text' => "Book Visa Consultation",
                        'button_link' => "/apply-now"
                    ]
                ]
            ]
        );
        // Application Support Page Seeder
        \App\Models\CmsPage::updateOrCreate(
            ['slug' => 'applications'],
            [
                'title' => 'Application Support',
                'sub_title' => 'Expert Application Services',
                'meta_title' => 'Application Support | Pioneers Admissions',
                'meta_description' => 'Navigate the complex university application process with confidence expert support.',
                'content' => [
                    'hero' => [
                        'badge' => 'Premium Support',
                        'title' => 'Expert Application Services',
                        'description' => 'Navigate the complex university application process with confidence. Our team of experts is with you every step of the way.',
                        'btn1_text' => 'Start Your Application',
                        'btn1_link' => '/apply-now',
                        'btn2_text' => 'How It Works',
                        'btn2_link' => '#process'
                    ],
                    'services' => [
                        'subtitle' => 'Our Expertise',
                        'title' => 'Comprehensive Application Support',
                        'description' => 'We provide end-to-end services to maximize your chances of acceptance.',
                        'items' => [
                            [
                                'title' => "University Selection",
                                'description' => "We help you identify the best universities based on your academic profile, career goals, and budget.",
                                'icon' => "faUniversity"
                            ],
                            [
                                'title' => "SOP & LOR Editing",
                                'description' => "Our experts refine your Statement of Purpose and Letters of Recommendation to make a compelling case.",
                                'icon' => "faFilePen"
                            ],
                            [
                                'title' => "Application Management",
                                'description' => "We handle the entire application process, ensuring every form is filled correctly and submitted on time.",
                                'icon' => "faCheckDouble"
                            ],
                            [
                                'title' => "Interview Preparation",
                                'description' => "Mock interviews and personalized coaching to help you ace your university or visa interviews.",
                                'icon' => "faUserTie"
                            ],
                            [
                                'title' => "Visa Assistance",
                                'description' => "Complete guidance on visa documentation, financial proof, and interview strategies.",
                                'icon' => "faPassport"
                            ],
                            [
                                'title' => "Timeline Planning",
                                'description' => "We create a customized timeline to ensure you meet all deadlines without stress.",
                                'icon' => "faCalendarCheck"
                            ]
                        ]
                    ],
                    'process' => [
                        'subtitle' => 'The Process',
                        'title' => 'Your Journey to Acceptance',
                        'description' => 'A structured approach designed to keep you organized and ahead of deadlines.',
                        'steps' => [
                            [
                                'number' => "01",
                                'title' => "Profile Evaluation",
                                'description' => "We analyze your academic background and career aspirations."
                            ],
                            [
                                'number' => "02",
                                'title' => "University Shortlisting",
                                'description' => "Selecting the right mix of ambitious, target, and safe universities."
                            ],
                            [
                                'number' => "03",
                                'title' => "Document Preparation",
                                'description' => "Drafting and refining your SOPs, LORs, and CVs."
                            ],
                            [
                                'number' => "04",
                                'title' => "Application Submission",
                                'description' => "Timely submission of applications to your chosen universities."
                            ]
                        ],
                        'stat' => [
                            'value' => '98%',
                            'label' => 'Success Rate',
                            'description' => 'Our students consistently secure offers from their top 3 university choices thanks to our strategic approach.'
                        ]
                    ],
                    'cta' => [
                        'title' => 'Ready to Start Your Journey?',
                        'description' => 'Book a free consultation with our experts and take the first step toward your dream university.',
                        'btn_text' => 'Book Free Consultation',
                        'btn_link' => '/apply-now'
                    ]
                ]
            ]
        );
    }
}
