@php
        $branding = $branding ?? \App\Support\SystemSettings::branding();
        $logoUrl = $branding['logo_url'] ?? asset('assets/logo.png');
        $appName = $branding['app_name'] ?? config('app.name', 'Dashboard');
@endphp

<aside class="app-sidebar" id="sidebar">

        <!-- Start::main-sidebar-header -->
        <div class="main-sidebar-header">
                <a href="{{ route('admin.dashboard') }}" class="header-logo ">
                        <img src="{{ $logoUrl }}" alt="{{ $appName }}"
                                class="main-logo desktop-logo bg-white h-10 w-auto">
                        <img src="{{ $logoUrl }}" alt="{{ $appName }}"
                                class="main-logo toggle-logo h-10 bg-white w-auto">
                        <img src="{{ $logoUrl }}" alt="{{ $appName }}"
                                class="main-logo desktop-white bg-white h-10 w-auto">
                        <img src="{{ $logoUrl }}" alt="{{ $appName }}" class="main-logo toggle-dark h-10 w-auto">
                </a>
        </div>
        <!-- End::main-sidebar-header -->

        <!-- Start::main-sidebar -->
        <div class="main-sidebar " id="sidebar-scroll">

                <!-- Start::nav -->
                <nav class="main-menu-container nav nav-pills flex-column sub-open">
                        <div class="slide-left" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#ffffffff"
                                        width="24" height="24" viewBox="0 0 24 24">
                                        <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z">
                                        </path>
                                </svg></div>
                        <ul class="main-menu">
                                <!-- Start::slide__category -->
                                <li class="slide__category"><span class="category-name">Main</span></li>
                                <!-- End::slide__category -->

                                <!-- Start::slide -->
                                <li class="slide ">
                                        <a href="{{ route('admin.dashboard')}}" class="side-menu__item">
                                                <i class="ri-home-8-line side-menu__icon"></i>
                                                <span class="side-menu__label">Dashboards</span>
                                        </a>

                                </li>
                                <!-- End::slide -->

                                <!-- Start::slide -->
                                <li class="slide">
                                        <a href="{{ route('admin.applications.index')}}" class="side-menu__item">
                                                <i class="ri-file-list-3-line side-menu__icon"></i>
                                                <span class="side-menu__label">Applications</span>
                                        </a>
                                </li>
                                <!-- End::slide -->

                                <!-- Start::slide__category -->
                                <li class="slide__category"><span class="category-name">CRUD Operations</span></li>
                                <!-- End::slide__category -->

                                <!-- Start::slide -->
                                <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">
                                                <i class="ri-inbox-line side-menu__icon"></i>
                                                <span class="side-menu__label">Basic Components</span>
                                                <i class="ri ri-arrow-right-s-line side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child1">
                                                <li class="slide side-menu__label1"><a href="javascript:void(0)"></a>
                                                </li>
                                                <li class="slide"><a href="{{ route('admin.countries.index')}}"
                                                                class="side-menu__item">Countries</a></li>
                                                <li class="slide"><a href="{{ route('admin.cities.index')}}"
                                                                class="side-menu__item">Cities</a>
                                                </li>
                                                <li class="slide"><a href="{{ route('admin.accreditations.index')}}"
                                                                class="side-menu__item">Accreditation</a></li>
                                                <li class="slide"><a href="{{ route('admin.tags.index')}}"
                                                                class="side-menu__item">Tags</a></li>
                                                <li class="slide"><a
                                                                href="{{ route('admin.language-course-tags.index')}}"
                                                                class="side-menu__item">Language Course Tags</a></li>
                                                <li class="slide"><a
                                                                href="{{ route('admin.language-course-types.index')}}"
                                                                class="side-menu__item">Language Course Types</a></li>
                                                <li class="slide"><a href="{{ route('admin.faqs.index') }}"
                                                                class="side-menu__item">Faqs</a>
                                                </li>
                                                <li class="slide"><a href="{{ route('admin.reviews.index')}}"
                                                                class="side-menu__item">Reviews</a></li>
                                                <li class="slide"><a href="{{ route('admin.video-reviews.index')}}"
                                                                class="side-menu__item">Video Reviews</a></li>
                                                <li class="slide"><a href="{{ route('admin.certifications.index')}}"
                                                                class="side-menu__item">Certifications</a></li>
                                                <li class="slide"><a href="buttons.html"
                                                                class="side-menu__item">Translations</a></li>
                                                <li class="slide"><a href="{{ route('admin.bathroom-types.index')}}"
                                                                class="side-menu__item">Bathroom Types</a></li>
                                                <li class="slide"><a href="{{ route('admin.bedroom-types.index')}}"
                                                                class="side-menu__item">Bedroom Types</a></li>
                                                <li class="slide"><a href="{{ route('admin.meal-plans.index')}}"
                                                                class="side-menu__item">Meal
                                                                Plans</a></li>
                                                <li class="slide"><a href="{{ route('admin.gallery.index') }}"
                                                                class="side-menu__item">Gallery</a></li>
                                                <li class="slide"><a href="{{ route('admin.rates.index') }}"
                                                                class="side-menu__item">Exchange
                                                                Rates</a></li>
                                                <li class="slide"><a href="{{ route('admin.conversion.index') }}"
                                                                class="side-menu__item">Conversion Fees</a></li>
                                                <li class="slide"><a href="{{ route('admin.preferred-schools.index') }}"
                                                                class="side-menu__item">Preferred Schools</a></li>
                                        </ul>
                                </li>
                                <!-- End::slide -->

                                <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">
                                                <i class="ri-article-line side-menu__icon"></i>
                                                <span class="side-menu__label">Content</span>
                                                <i class="ri ri-arrow-right-s-line side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child1">
                                                <li class="slide side-menu__label1"><a
                                                                href="javascript:void(0)">Content</a></li>
                                                <li class="slide"><a href="{{ route('admin.categories.index') }}"
                                                                class="side-menu__item">Blog
                                                                Categories</a></li>
                                                <li class="slide"><a href="{{ route('admin.blogs.index')}}"
                                                                class="side-menu__item">All
                                                                Blogs</a></li>
                                                <li class="slide"><a href="{{ route('admin.blog-tags.index')}}"
                                                                class="side-menu__item">Manage
                                                                Blog Tags</a></li>
                                        </ul>
                                </li>

                                <li class="slide__category"><span class="category-name">User Management</span></li>

                                <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">
                                                <i class="ri-account-circle-line side-menu__icon"></i>
                                                <span class="side-menu__label">Manage Users</span>
                                                <i class="ri ri-arrow-right-s-line side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child1">
                                                <li class="slide side-menu__label1"><a href="javascript:void(0)">Manage
                                                                Users</a></li>
                                                <li class="slide"><a href="{{ route('admin.users.index') }}"
                                                                class="side-menu__item">All
                                                                Users</a></li>
                                                <li class="slide"><a href="{{ route('admin.users.role', 'admin') }}"
                                                                class="side-menu__item">Admins</a></li>
                                                <li class="slide"><a href="{{ route('admin.users.role', 'team') }}"
                                                                class="side-menu__item">Team</a></li>
                                                <li class="slide"><a href="{{ route('admin.users.role', 'counselor') }}"
                                                                class="side-menu__item">Counselors</a></li>
                                                <li class="slide"><a href="{{ route('admin.users.role', 'agent') }}"
                                                                class="side-menu__item">Agents</a></li>
                                                <li class="slide"><a href="{{ route('admin.users.role', 'school') }}"
                                                                class="side-menu__item">Schools</a></li>
                                                <li class="slide"><a href="{{ route('admin.users.role', 'student') }}"
                                                                class="side-menu__item">Students</a></li>
                                        </ul>
                                </li>

                                <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">
                                                <i class="ri-handshake-line side-menu__icon"></i>
                                                <span class="side-menu__label">Manage Agents</span>
                                                <i class="ri ri-arrow-right-s-line side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child1">
                                                <li class="slide side-menu__label1"><a href="javascript:void(0)">Manage
                                                                Agents</a></li>
                                                <li class="slide"><a href="{{ route('admin.referrals.index') }}"
                                                                class="side-menu__item">Referral Settings</a></li>
                                                <li class="slide"><a href="{{ route('admin.referrals.students') }}"
                                                                class="side-menu__item">Referral Students</a></li>
                                        </ul>
                                </li>

                                <li class="slide__category"><span class="category-name">School Elements</span></li>

                                <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">
                                                <i class="ri-building-2-line side-menu__icon"></i>
                                                <span class="side-menu__label">School Setup</span>
                                                <i class="ri ri-arrow-right-s-line side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child1">
                                                <li class="slide side-menu__label1"><a href="javascript:void(0)">School
                                                                Setup</a></li>
                                                <li class="slide"><a href="{{ route('admin.schools.index') }}"
                                                                class="side-menu__item">Schools</a></li>
                                                <li class="slide"><a href="{{ route('admin.school-branches.index') }}"
                                                                class="side-menu__item">School Branches</a></li>
                                                <li class="slide"><a
                                                                href="{{ route('admin.branch-registration-fees.index') }}"
                                                                class="side-menu__item">Registration Fees</a></li>
                                                <li class="slide"><a
                                                                href="{{ route('admin.branch-high-season-fees.index') }}"
                                                                class="side-menu__item">High Season Fees</a></li>
                                                <li class="slide"><a href="{{ route('admin.accommodations.index') }}"
                                                                class="side-menu__item">Accommodations</a></li>
                                                <li class="slide"><a href="{{ route('admin.supplements.index') }}"
                                                                class="side-menu__item">Supplements</a></li>
                                                <li class="slide"><a href="{{ route('admin.pickups.index') }}"
                                                                class="side-menu__item">Pickups</a></li>
                                                <li class="slide"><a href="{{ route('admin.insurance-fees.index') }}"
                                                                class="side-menu__item">Insurance Fees</a></li>

                                        </ul>
                                </li>
                                <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">
                                                <i class="ri-book-open-line side-menu__icon"></i>
                                                <span class="side-menu__label">General Courses</span>
                                                <i class="ri ri-arrow-right-s-line side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child1">
                                                <li class="slide side-menu__label1"><a href="javascript:void(0)">General
                                                                Courses</a></li>
                                                <li class="slide"><a href="{{ route('admin.language-courses.index')}}"
                                                                class="side-menu__item">Language Courses</a></li>
                                                <li class="slide"><a
                                                                href="{{ route('admin.language-course-material-fees.index') }}"
                                                                class="side-menu__item">Course Material Fees</a></li>
                                                <li class="slide"><a
                                                                href="{{ route('admin.language-course-fees.index') }}"
                                                                class="side-menu__item">Language Course Fees</a></li>

                                        </ul>
                                </li>

                                <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">
                                                <i class="ri-macbook-line side-menu__icon"></i>
                                                <span class="side-menu__label">Online Courses</span>
                                                <i class="ri ri-arrow-right-s-line side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child1">
                                                <li class="slide side-menu__label1"><a href="javascript:void(0)">Online
                                                                Courses</a></li>
                                                <li class="slide"><a href="{{ route('admin.online-courses.index') }}"
                                                                class="side-menu__item">Online Courses</a></li>
                                        </ul>
                                </li>

                                <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">
                                                <i class="ri-sun-line side-menu__icon"></i>
                                                <span class="side-menu__label">Summer Camps</span>
                                                <i class="ri ri-arrow-right-s-line side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child1">
                                                <li class="slide side-menu__label1"><a href="javascript:void(0)">Summer
                                                                Camps</a></li>
                                                <li class="slide"><a href="{{ route('admin.summer-camps.index') }}"
                                                                class="side-menu__item">Summer Camps</a></li>
                                                <li class="slide"><a
                                                                href="{{ route('admin.summer-camp-details.index') }}"
                                                                class="side-menu__item">Camp Details</a></li>
                                                <li class="slide"><a href="{{ route('admin.camp-infos.index') }}"
                                                                class="side-menu__item">Camp
                                                                Infos</a></li>
                                                <li class="slide"><a href="{{ route('admin.camp-fees.index') }}"
                                                                class="side-menu__item">Camp
                                                                Fees</a></li>
                                                <li class="slide"><a href="{{ route('admin.camp-media.index') }}"
                                                                class="side-menu__item">Camp
                                                                Media</a></li>
                                        </ul>
                                </li>

                                <li class="slide__category"><span class="category-name">University Elements</span></li>

                                <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">
                                                <i class="ri-map-pin-line side-menu__icon"></i>
                                                <span class="side-menu__label">Destinations</span>
                                                <i class="ri ri-arrow-right-s-line side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child1">
                                                <li class="slide side-menu__label1"><a
                                                                href="javascript:void(0)">Destinations</a></li>
                                                <li class="slide"><a href="{{ route('admin.destinations.index') }}"
                                                                class="side-menu__item">All
                                                                Destinations</a></li>
                                                <li class="slide"><a href="{{ route('admin.destinations.create') }}"
                                                                class="side-menu__item">Create Destination</a></li>
                                        </ul>
                                </li>

                                <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">
                                                <i class="ri-community-line side-menu__icon"></i>
                                                <span class="side-menu__label">Universities</span>
                                                <i class="ri ri-arrow-right-s-line side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child1">
                                                <li class="slide side-menu__label1"><a
                                                                href="javascript:void(0)">Universities</a></li>
                                                <li class="slide"><a href="{{ route('admin.universities.index') }}"
                                                                class="side-menu__item">All
                                                                Universities</a></li>
                                                <li class="slide"><a href="{{ route('admin.universities.create') }}"
                                                                class="side-menu__item">Create University</a></li>
                                                <li class="slide"><a href="{{ route('admin.campuses.index') }}"
                                                                class="side-menu__item">Campuses</a></li>
                                                <li class="slide"><a href="{{ route('admin.campuses.create') }}"
                                                                class="side-menu__item">Add
                                                                Campus</a></li>
                                                <li class="slide"><a
                                                                href="{{ route('admin.university-courses.index') }}"
                                                                class="side-menu__item">University Courses</a></li>
                                                <li class="slide"><a
                                                                href="{{ route('admin.university-courses.create') }}"
                                                                class="side-menu__item">Add University Course</a></li>
                                                <li class="slide"><a href="{{ route('admin.intakes.index') }}"
                                                                class="side-menu__item">Intakes</a></li>
                                                <li class="slide"><a href="{{ route('admin.intakes.create') }}"
                                                                class="side-menu__item">Add
                                                                Intake</a></li>
                                                <li class="slide"><a
                                                                href="{{ route('admin.course-requirements.index') }}"
                                                                class="side-menu__item">Course Requirements</a></li>
                                                <li class="slide"><a
                                                                href="{{ route('admin.course-requirements.create') }}"
                                                                class="side-menu__item">Add Requirement</a></li>
                                        </ul>
                                </li>


                                <!-- Start::slide -->
                                <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">
                                                <i class="ti ti-discount side-menu__icon"></i>
                                                <span class="side-menu__label">Discounts</span>
                                                <i class="ri ri-arrow-right-s-line side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child1">
                                                <li class="slide side-menu__label1"><a
                                                                href="javascript:void(0)">Discounts</a></li>
                                                <li class="slide"><a href="{{ route('admin.discounts.index') }}"
                                                                class="side-menu__item">Discounts</a></li>
                                                <li class="slide"><a href="{{ route('admin.coupons.index') }}"
                                                                class="side-menu__item">Coupons</a></li>
                                                <li class="slide"><a
                                                                href="{{ route('admin.pioneers-discounts.index') }}"
                                                                class="side-menu__item">Pioneers Discounts</a></li>

                                        </ul>
                                </li>
                                <!-- End::slide -->

                                <li class="slide__category"><span class="category-name">CMS Projects</span></li>

                                <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">
                                                <i class="ri-pages-line side-menu__icon"></i>
                                                <span class="side-menu__label">University</span>
                                                <i class="ri ri-arrow-right-s-line side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child1">
                                                <li class="slide side-menu__label1"><a
                                                                href="javascript:void(0)">University</a></li>
                                                <li class="slide"><a href="{{ route('admin.cms.university.home') }}"
                                                                class="side-menu__item">Home Page</a></li>
                                        </ul>
                                </li>

                                <li class="slide">
                                        <a href="{{ route('admin.cms.course-english.index') }}" class="side-menu__item">
                                                <i class="ri-english-input keybaord side-menu__icon"></i>
                                                <span class="side-menu__label">CourseEnglish</span>
                                        </a>
                                </li>

                                <li class="slide__category"><span class="category-name">Settings</span></li>

                                <li class="slide">
                                        <a href="{{ route('admin.settings.index') }}" class="side-menu__item">
                                                <i class="ri-settings-3-line side-menu__icon"></i>
                                                <span class="side-menu__label">Application Settings</span>
                                        </a>
                                </li>
                                <li class="slide">
                                        <a href="{{ route('admin.referrals.index') }}" class="side-menu__item">
                                                <i class="ri-links-line side-menu__icon"></i>
                                                <span class="side-menu__label">Agent Referrals</span>
                                        </a>
                                </li>


                        </ul>
                        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                                        width="24" height="24" viewBox="0 0 24 24">
                                        <path
                                                d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                        </path>
                                </svg></div>
                </nav>
                <!-- End::nav -->

        </div>
        <!-- End::main-sidebar -->

</aside>