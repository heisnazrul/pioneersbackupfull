@php
        $branding = \App\Support\SystemSettings::branding();
        $logo = $branding['logo_url'] ?? asset('assets/img/brand-logos/desktop-logo.png');
        $logoDark = $branding['logo_url'] ?? asset('assets/img/brand-logos/desktop-dark.png');
        $toggle = $branding['favicon_url'] ?? asset('assets/img/brand-logos/toggle-logo.png');
        $toggleDark = $branding['favicon_url'] ?? asset('assets/img/brand-logos/toggle-dark.png');
@endphp

<aside class="app-sidebar sticky" id="sidebar">

        <!-- Start::main-sidebar-header -->
        <div class="main-sidebar-header">
                <a href="{{ route('admin.dashboard') }}" class="header-logo">
                        @if(!empty($branding['logo_url']))
                                {{-- Custom Logo: Display one image for both modes since it's the same file --}}
                                <img src="{{ $branding['logo_url'] }}" alt="logo" class="desktop-logo"
                                        style="max-height: 3rem; object-fit: contain; display: block !important;">
                                <img src="{{ $branding['logo_url'] }}" alt="logo" class="toggle-logo"
                                        style="max-height: 3rem; object-fit: contain; display: none !important;">
                        @else
                                {{-- Default Theme Logos --}}
                                <img src="{{ asset('assets/img/brand-logos/desktop-logo.png') }}" alt="logo"
                                        class="desktop-logo">
                                <img src="{{ asset('assets/img/brand-logos/toggle-logo.png') }}" alt="logo" class="toggle-logo">
                                <img src="{{ asset('assets/img/brand-logos/desktop-dark.png') }}" alt="logo"
                                        class="desktop-dark">
                                <img src="{{ asset('assets/img/brand-logos/toggle-dark.png') }}" alt="logo" class="toggle-dark">
                        @endif
                </a>
        </div>
        <!-- End::main-sidebar-header -->

        <!-- Start::main-sidebar -->
        <div class="main-sidebar" id="sidebar-scroll">

                <!-- Start::nav -->
                <nav class="main-menu-container nav nav-pills flex-column sub-open">
                        <div class="slide-left" id="slide-left">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z">
                                        </path>
                                </svg>
                        </div>
                        <ul class="main-menu">
                                <!-- Start::slide__category -->
                                <li class="slide__category"><span class="category-name">Main</span></li>
                                <!-- End::slide__category -->

                                <!-- Dashboard -->
                                <li class="slide">
                                        <a href="{{ route('admin.dashboard') }}" class="side-menu__item">
                                                <i class="ri-home-8-line side-menu__icon"></i>
                                                <span class="side-menu__label">Dashboard</span>
                                        </a>
                                </li>

                                <!-- Start::slide__category -->
                                <li class="slide__category"><span class="category-name">Access Control</span></li>
                                <!-- End::slide__category -->

                                <!-- User Management -->
                                <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">
                                                <i class="ri-user-settings-line side-menu__icon"></i>
                                                <span class="side-menu__label">User Management</span>
                                                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child1">
                                                <li class="slide"><a href="{{ route('admin.users.index') }}"
                                                                class="side-menu__item">All Users</a></li>
                                        </ul>
                                </li>

                                <!-- Applications -->
                                <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">
                                                <i class="ri-file-list-3-line side-menu__icon"></i>
                                                <span class="side-menu__label">Applications</span>
                                                <span
                                                        class="badge bg-success/10 text-success !border-0 ms-auto">New</span>
                                                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child1">
                                                <li class="slide"><a href="{{ route('admin.applications.index') }}"
                                                                class="side-menu__item">All Applications</a></li>
                                                <li class="slide"><a
                                                                href="{{ route('admin.scholarship-applications.index') }}"
                                                                class="side-menu__item">Scholarship Apps</a></li>
                                                <li class="slide"><a href="{{ route('admin.uni-applications.index') }}"
                                                                class="side-menu__item">Uni Applications</a></li>
                                                <li class="slide"><a
                                                                href="{{ route('admin.contact-submissions.index') }}"
                                                                class="side-menu__item">Contact Inquiries</a></li>
                                        </ul>
                                </li>

                                <!-- Start::slide__category -->
                                <li class="slide__category"><span class="category-name">University System</span></li>
                                <!-- End::slide__category -->

                                <!-- Universities -->
                                <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">
                                                <i class="ri-government-line side-menu__icon"></i>
                                                <span class="side-menu__label">Universities</span>
                                                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child1">
                                                <li class="slide"><a href="{{ route('admin.universities.index') }}"
                                                                class="side-menu__item">All Universities</a></li>
                                                <li class="slide"><a href="{{ route('admin.campuses.index') }}"
                                                                class="side-menu__item">Campuses</a></li>
                                                <li class="slide"><a href="{{ route('admin.destinations.index') }}"
                                                                class="side-menu__item">Destinations</a></li>
                                                <li class="slide"><a
                                                                href="{{ route('admin.university-courses.index') }}"
                                                                class="side-menu__item">Courses</a></li>
                                                <li class="slide"><a href="{{ route('admin.scholarships.index') }}"
                                                                class="side-menu__item">Scholarships</a></li>

                                        </ul>
                                </li>

                                <!-- Course Attributes -->
                                <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">
                                                <i class="ri-list-settings-line side-menu__icon"></i>
                                                <span class="side-menu__label">Course Attributes</span>
                                                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child1">
                                                <li class="slide side-menu__label1">
                                                        <a href="javascript:void(0)">Course Attributes</a>
                                                </li>
                                                <li class="slide"><a href="{{ route('admin.levels.index') }}"
                                                                class="side-menu__item">Study Levels</a></li>
                                                <li class="slide"><a href="{{ route('admin.subject-areas.index') }}"
                                                                class="side-menu__item">Subject Areas</a></li>
                                                <li class="slide"><a href="{{ route('admin.intake-terms.index') }}"
                                                                class="side-menu__item">Intake Terms</a></li>
                                                <li class="slide"><a href="{{ route('admin.language-tests.index') }}"
                                                                class="side-menu__item">Language Tests</a></li>
                                                <li class="slide"><a href="{{ route('admin.course-tags.index') }}"
                                                                class="side-menu__item">Course Tags</a></li>
                                                <li class="slide"><a href="{{ route('admin.featured-lists.index') }}"
                                                                class="side-menu__item">Featured Lists</a></li>
                                        </ul>
                                </li>

                                <!-- Start::slide__category -->
                                <li class="slide__category"><span class="category-name">Content</span></li>
                                <!-- End::slide__category -->

                                <!-- Contents -->
                                <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">
                                                <i class="ri-article-line side-menu__icon"></i>
                                                <span class="side-menu__label">Contents</span>
                                                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child1">
                                                <li class="slide"><a href="{{ route('admin.blogs.index') }}"
                                                                class="side-menu__item">Blogs</a></li>
                                                <li class="slide"><a href="{{ route('admin.categories.index') }}"
                                                                class="side-menu__item">Categories</a></li>
                                                <li class="slide"><a href="{{ route('admin.blog-tags.index') }}"
                                                                class="side-menu__item">Deep Tags</a></li>
                                                <li class="slide"><a href="{{ route('admin.reviews.index') }}"
                                                                class="side-menu__item">Reviews</a></li>

                                                <li class="slide"><a href="{{ route('admin.faqs.index') }}"
                                                                class="side-menu__item">FAQs</a></li>
                                                <li class="slide"><a href="{{ route('admin.certifications.index') }}"
                                                                class="side-menu__item">Certifications</a></li>
                                                <li class="slide"><a
                                                                href="{{ route('admin.destination-guides.index') }}"
                                                                class="side-menu__item">Destination Guides</a></li>
                                                <li class="slide"><a
                                                                href="{{ route('admin.accommodation-rooms.index') }}"
                                                                class="side-menu__item">Accommodation Rooms</a></li>
                                                <li class="slide"><a href="{{ route('admin.cms-pages.index') }}"
                                                                class="side-menu__item">CMS Pages</a></li>
                                        </ul>
                                </li>

                                <!-- Start::slide__category -->
                                <li class="slide__category"><span class="category-name">Utilities</span></li>
                                <!-- End::slide__category -->

                                <!-- Locations -->
                                <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">
                                                <i class="ri-global-line side-menu__icon"></i>
                                                <span class="side-menu__label">Locations</span>
                                                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child1">
                                                <li class="slide"><a href="{{ route('admin.countries.index') }}"
                                                                class="side-menu__item">Countries</a></li>
                                                <li class="slide"><a href="{{ route('admin.cities.index') }}"
                                                                class="side-menu__item">Cities</a></li>
                                        </ul>
                                </li>

                                <!-- Settings -->
                                <li class="slide">
                                        <a href="{{ route('admin.settings.index') }}" class="side-menu__item">
                                                <i class="ri-settings-4-line side-menu__icon"></i>
                                                <span class="side-menu__label">Settings</span>
                                        </a>
                                </li>
                                <li class="slide">
                                        <a href="{{ route('admin.offices.index') }}" class="side-menu__item">
                                                <i class="ri-building-4-line side-menu__icon"></i>
                                                <span class="side-menu__label">Offices</span>
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