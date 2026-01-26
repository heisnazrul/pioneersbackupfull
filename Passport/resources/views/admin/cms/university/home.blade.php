@extends('admin.layouts.layout')

@section('content')
    <div class="main-content">
        <!-- Page Header -->
        <div class="flex justify-between items-center my-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">University Home CMS</h2>
            <ol class="flex items-center whitespace-nowrap min-w-0">
                <li class="text-sm"> <a class="flex items-center text-primary hover:text-primary dark:text-primary"
                        href="#">CMS</a> </li>
                <li class="text-sm"> <i
                        class="ti ti-chevrons-right flex-shrink-0 mx-3 overflow-visible text-gray-300 dark:text-gray-300 rtl:rotate-180"></i>
                </li>
                <li class="text-sm text-gray-500 dark:text-white/70 hover:text-primary truncate" aria-current="page">
                    University Home</li>
            </ol>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <span class="font-medium">Success!</span> {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-12 gap-6">

            <div class="col-span-12">

                <!-- 1. HERO SECTION -->
                <form action="{{ route('admin.cms.university.home.update', 'hero') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="box border border-gray-200 dark:border-white/10 mb-6">
                        <div class="box-header justify-between">
                            <h5 class="box-title">1. Hero Section</h5>
                        </div>
                        <div class="box-body">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12 md:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Hero
                                        Title</label>
                                    <input type="text" name="hero_title" value="{{ $hero['hero_title'] ?? '' }}"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        placeholder="Shape Your Future...">
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Hero
                                        Subtitle</label>
                                    <textarea name="hero_subtitle" rows="2"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        placeholder="Expert guidance...">{{ $hero['hero_subtitle'] ?? '' }}</textarea>
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Background
                                        Image</label>
                                    <input type="file" name="hero_bg"
                                        class="block w-full border border-gray-200 focus:shadow-sm dark:focus:shadow-white/10 rounded-sm text-sm focus:z-10 focus:outline-none focus:border-gray-200 dark:focus:border-white/10 dark:border-white/10 dark:text-white/70 file:border-0 file:bg-gray-100 file:me-4 file:py-2 file:px-4 dark:file:bg-black/20 dark:file:text-white/70">
                                    @if(isset($hero['hero_bg']))
                                        <div class="mt-2">
                                            <a href="{{ asset('storage/' . $hero['hero_bg']) }}" target="_blank"
                                                class="text-xs text-primary underline">View Current Image</a>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Hero
                                        Figure</label>
                                    <input type="file" name="hero_figure"
                                        class="block w-full border border-gray-200 focus:shadow-sm dark:focus:shadow-white/10 rounded-sm text-sm focus:z-10 focus:outline-none focus:border-gray-200 dark:focus:border-white/10 dark:border-white/10 dark:text-white/70 file:border-0 file:bg-gray-100 file:me-4 file:py-2 file:px-4 dark:file:bg-black/20 dark:file:text-white/70">
                                    @if(isset($hero['hero_figure']))
                                        <div class="mt-2">
                                            <a href="{{ asset('storage/' . $hero['hero_figure']) }}" target="_blank"
                                                class="text-xs text-primary underline">View Current Image</a>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Tab 1
                                        Text</label>
                                    <input type="text" name="hero_tab_1_text"
                                        value="{{ $hero['hero_tab_1_text'] ?? 'Find Courses' }}"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70">
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Tab 2
                                        Text</label>
                                    <input type="text" name="hero_tab_2_text"
                                        value="{{ $hero['hero_tab_2_text'] ?? 'Find Universities' }}"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70">
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Button
                                        Text</label>
                                    <input type="text" name="hero_button_text"
                                        value="{{ $hero['hero_button_text'] ?? 'Search' }}"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70">
                                </div>

                                <div class="col-span-12 border-t border-gray-200 dark:border-white/10 my-4"></div>

                                <!-- Search Module Labels & Placeholders -->
                                <div class="col-span-12 md:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Search
                                        Courses Label</label>
                                    <input type="text" name="hero_search_courses_label"
                                        value="{{ $hero['hero_search_courses_label'] ?? 'SEARCH COURSES' }}"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70">
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Search
                                        Universities Label</label>
                                    <input type="text" name="hero_search_universities_label"
                                        value="{{ $hero['hero_search_universities_label'] ?? 'SEARCH UNIVERSITIES' }}"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70">
                                </div>

                                <div class="col-span-12 md:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Courses
                                        Placeholder</label>
                                    <input type="text" name="hero_search_courses_placeholder"
                                        value="{{ $hero['hero_search_courses_placeholder'] ?? 'e.g. Computer Science, MBA...' }}"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70">
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Universities
                                        Placeholder</label>
                                    <input type="text" name="hero_search_universities_placeholder"
                                        value="{{ $hero['hero_search_universities_placeholder'] ?? 'e.g. Oxford, Harvard...' }}"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70">
                                </div>

                                <div class="col-span-12 md:col-span-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Country
                                        Label</label>
                                    <input type="text" name="hero_country_label"
                                        value="{{ $hero['hero_country_label'] ?? 'COUNTRY' }}"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70">
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Study Level
                                        Label</label>
                                    <input type="text" name="hero_study_level_label"
                                        value="{{ $hero['hero_study_level_label'] ?? 'STUDY LEVEL' }}"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70">
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Intake
                                        Label</label>
                                    <input type="text" name="hero_intake_label"
                                        value="{{ $hero['hero_intake_label'] ?? 'INTAKE' }}"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70">
                                </div>

                                <div class="col-span-12 md:col-span-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Country
                                        Placeholder</label>
                                    <input type="text" name="hero_country_placeholder"
                                        value="{{ $hero['hero_country_placeholder'] ?? 'All Countries' }}"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70">
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Study Level
                                        Placeholder</label>
                                    <input type="text" name="hero_study_level_placeholder"
                                        value="{{ $hero['hero_study_level_placeholder'] ?? 'Select...' }}"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70">
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Intake
                                        Placeholder</label>
                                    <input type="text" name="hero_intake_placeholder"
                                        value="{{ $hero['hero_intake_placeholder'] ?? 'Any Intake' }}"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer text-end border-t border-gray-200 dark:border-white/10 p-4">
                            <button type="submit" class="ti-btn ti-btn-primary">
                                <i class="ti ti-device-floppy"></i> Save Hero Section
                            </button>
                        </div>
                    </div>
                </form>

                <!-- 2. STATS SECTION -->
                <form action="{{ route('admin.cms.university.home.update', 'stats') }}" method="POST">
                    @csrf
                    <div class="box border border-gray-200 dark:border-white/10 mb-6">
                        <div class="box-header">
                            <h5 class="box-title">2. Stats Section</h5>
                        </div>
                        <div class="box-body">
                            <p class="text-gray-500 text-sm mb-4">Manage key statistics displayed on the home page.</p>
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12 md:col-span-6">
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Heading</label>
                                    <input type="text" name="stats_heading"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $stats['stats_heading'] ?? '' }}">
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Description</label>
                                    <textarea name="stats_description" rows="2"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70">{{ $stats['stats_description'] ?? '' }}</textarea>
                                </div>

                                <div class="col-span-12 border-t border-gray-200 dark:border-white/10 my-2"></div>

                                <div class="col-span-12 md:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Stat 1
                                        Value</label>
                                    <input type="text" name="stat_1_value"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $stats['stat_1_value'] ?? '' }}">
                                </div>
                                <div class="col-span-12 md:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Stat 1
                                        Label</label>
                                    <input type="text" name="stat_1_label"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $stats['stat_1_label'] ?? '' }}">
                                </div>
                                <div class="col-span-12 md:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Stat 2
                                        Value</label>
                                    <input type="text" name="stat_2_value"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $stats['stat_2_value'] ?? '' }}">
                                </div>
                                <div class="col-span-12 md:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Stat 2
                                        Label</label>
                                    <input type="text" name="stat_2_label"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $stats['stat_2_label'] ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer text-end border-t border-gray-200 dark:border-white/10 p-4">
                            <button type="submit" class="ti-btn ti-btn-primary">
                                <i class="ti ti-device-floppy"></i> Save Stats
                            </button>
                        </div>
                    </div>
                </form>

                <!-- 3. CERTIFICATES SECTION -->
                <form action="{{ route('admin.cms.university.home.update', 'certificates') }}" method="POST">
                    @csrf
                    <div class="box border border-gray-200 dark:border-white/10 mb-6">
                        <div class="box-header">
                            <h5 class="box-title">3. Certificates Section</h5>
                        </div>
                        <div class="box-body">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12 md:col-span-6">
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Heading</label>
                                    <input type="text" name="certificates_heading"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $certificates['certificates_heading'] ?? '' }}">
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Subtitle</label>
                                    <textarea name="certificates_subtitle" rows="2"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70">{{ $certificates['certificates_subtitle'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer text-end border-t border-gray-200 dark:border-white/10 p-4">
                            <button type="submit" class="ti-btn ti-btn-primary">
                                <i class="ti ti-device-floppy"></i> Save Certificates
                            </button>
                        </div>
                    </div>
                </form>

                <!-- 4. DESTINATIONS SECTION -->
                <form action="{{ route('admin.cms.university.home.update', 'destinations') }}" method="POST">
                    @csrf
                    <div class="box border border-gray-200 dark:border-white/10 mb-6">
                        <div class="box-header">
                            <h5 class="box-title">4. Destinations Section</h5>
                        </div>
                        <div class="box-body">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12 md:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Section
                                        Heading</label>
                                    <input type="text" name="destinations_heading"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $destinations['destinations_heading'] ?? '' }}">
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Section
                                        Subtitle</label>
                                    <input type="text" name="destinations_subtitle"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $destinations['destinations_subtitle'] ?? '' }}">
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Button
                                        Text</label>
                                    <input type="text" name="destinations_button_text"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $destinations['destinations_button_text'] ?? 'View All Countries →' }}">
                                </div>
                                <div class="col-span-12">
                                    <div
                                        class="bg-blue-50 border border-blue-200 text-blue-800 text-sm rounded-sm p-4 dark:bg-blue-800/20 dark:border-blue-800/40 dark:text-blue-200">
                                        <i class="ti ti-info-circle"></i> Note: The content for this section is dynamically
                                        pulled from the <strong>Destinations</strong> module.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer text-end border-t border-gray-200 dark:border-white/10 p-4">
                            <button type="submit" class="ti-btn ti-btn-primary">
                                <i class="ti ti-device-floppy"></i> Save Destinations
                            </button>
                        </div>
                    </div>
                </form>

                <!-- 5. UNIVERSITIES SECTION -->
                <form action="{{ route('admin.cms.university.home.update', 'universities') }}" method="POST">
                    @csrf
                    <div class="box border border-gray-200 dark:border-white/10 mb-6">
                        <div class="box-header">
                            <h5 class="box-title">5. Universities Section</h5>
                        </div>
                        <div class="box-body">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12 md:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Section
                                        Heading</label>
                                    <input type="text" name="universities_heading"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $universities['universities_heading'] ?? '' }}">
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Section
                                        Subtitle</label>
                                    <input type="text" name="universities_subtitle"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $universities['universities_subtitle'] ?? '' }}">
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Button
                                        Text</label>
                                    <input type="text" name="universities_button_text"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $universities['universities_button_text'] ?? 'Browse Universities →' }}">
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Button
                                        Link</label>
                                    <input type="text" name="universities_button_link"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $universities['universities_button_link'] ?? '/search' }}">
                                </div>
                                <div class="col-span-12">
                                    <div
                                        class="bg-blue-50 border border-blue-200 text-blue-800 text-sm rounded-sm p-4 dark:bg-blue-800/20 dark:border-blue-800/40 dark:text-blue-200">
                                        <i class="ti ti-info-circle"></i> Note: The content for this section is dynamically
                                        pulled from the <strong>Universities</strong> module.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer text-end border-t border-gray-200 dark:border-white/10 p-4">
                            <button type="submit" class="ti-btn ti-btn-primary">
                                <i class="ti ti-device-floppy"></i> Save Universities
                            </button>
                        </div>
                    </div>
                </form>

                <!-- 6. REVIEWS SECTION -->
                <form action="{{ route('admin.cms.university.home.update', 'reviews') }}" method="POST">
                    @csrf
                    <div class="box border border-gray-200 dark:border-white/10 mb-6">
                        <div class="box-header">
                            <h5 class="box-title">6. Reviews Section</h5>
                        </div>
                        <div class="box-body">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12 md:col-span-6">
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Heading</label>
                                    <input type="text" name="reviews_heading"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $reviews['reviews_heading'] ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer text-end border-t border-gray-200 dark:border-white/10 p-4">
                            <button type="submit" class="ti-btn ti-btn-primary">
                                <i class="ti ti-device-floppy"></i> Save Reviews
                            </button>
                        </div>
                    </div>
                </form>

                <!-- 7. BLOGS SECTION -->
                <form action="{{ route('admin.cms.university.home.update', 'blogs') }}" method="POST">
                    @csrf
                    <div class="box border border-gray-200 dark:border-white/10 mb-6">
                        <div class="box-header">
                            <h5 class="box-title">7. Blogs Section</h5>
                        </div>
                        <div class="box-body">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12 md:col-span-6">
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Heading</label>
                                    <input type="text" name="blogs_heading"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $blogs['blogs_heading'] ?? '' }}">
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Button
                                        Text</label>
                                    <input type="text" name="blogs_button_text"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $blogs['blogs_button_text'] ?? 'All articles' }}">
                                </div>
                                <div class="col-span-12">
                                    <div
                                        class="bg-blue-50 border border-blue-200 text-blue-800 text-sm rounded-sm p-4 dark:bg-blue-800/20 dark:border-blue-800/40 dark:text-blue-200">
                                        <i class="ti ti-info-circle"></i> Note: The actual blog posts are pulled dynamically
                                        from the <strong>Blogs</strong> module API.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer text-end border-t border-gray-200 dark:border-white/10 p-4">
                            <button type="submit" class="ti-btn ti-btn-primary">
                                <i class="ti ti-device-floppy"></i> Save Blogs
                            </button>
                        </div>
                    </div>
                </form>

                <!-- 8. WHY CHOOSE SECTION -->
                <form action="{{ route('admin.cms.university.home.update', 'why_choose') }}" method="POST">
                    @csrf
                    <div class="box border border-gray-200 dark:border-white/10 mb-6">
                        <div class="box-header">
                            <h5 class="box-title">8. Why Choose Section</h5>
                        </div>
                        <div class="box-body">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12 md:col-span-6">
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Heading</label>
                                    <input type="text" name="why_choose_heading"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $whyChoose['why_choose_heading'] ?? '' }}">
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Subtitle</label>
                                    <input type="text" name="why_choose_subtitle"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $whyChoose['why_choose_subtitle'] ?? '' }}">
                                </div>
                                <div class="col-span-12 border-t border-gray-200 dark:border-white/10 my-2"></div>

                                {{-- 5 Items Loop --}}
                                @for($i = 1; $i <= 5; $i++)
                                    <div class="col-span-12 md:col-span-4 box border border-gray-100 p-3 rounded bg-gray-50/50">
                                        <h6 class="font-bold text-xs uppercase text-gray-500 mb-2">Item {{ $i }}</h6>

                                        <label
                                            class="block text-xs font-medium text-gray-700 dark:text-white mb-1">Title</label>
                                        <input type="text" name="item_{{ $i }}_title"
                                            class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70 mb-2"
                                            value="{{ $whyChoose['item_' . $i . '_title'] ?? '' }}">

                                        <label
                                            class="block text-xs font-medium text-gray-700 dark:text-white mb-1">Description</label>
                                        <textarea name="item_{{ $i }}_description" rows="2"
                                            class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70 mb-2">{{ $whyChoose['item_' . $i . '_description'] ?? '' }}</textarea>

                                        <label class="block text-xs font-medium text-gray-700 dark:text-white mb-1">Icon (gift,
                                            eye, user-check, check-circle, globe)</label>
                                        <input type="text" name="item_{{ $i }}_icon"
                                            class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                            value="{{ $whyChoose['item_' . $i . '_icon'] ?? '' }}" placeholder="e.g. gift">
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <div class="box-footer text-end border-t border-gray-200 dark:border-white/10 p-4">
                            <button type="submit" class="ti-btn ti-btn-primary">
                                <i class="ti ti-device-floppy"></i> Save Why Choose
                            </button>
                        </div>
                    </div>
                </form>

                <!-- 9. OTHER SECTIONS -->
                <form action="{{ route('admin.cms.university.home.update', 'other') }}" method="POST">
                    @csrf
                    <div class="box border border-gray-200 dark:border-white/10 mb-6">
                        <div class="box-header">
                            <h5 class="box-title">9. Other Sections</h5>
                        </div>
                        <div class="box-body">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12 md:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Scholarships
                                        Heading</label>
                                    <input type="text" name="other_scholarships_heading"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $other['other_scholarships_heading'] ?? '' }}">
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Why Choose
                                        Heading</label>
                                    <input type="text" name="other_why_choose_heading"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $other['other_why_choose_heading'] ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer text-end border-t border-gray-200 dark:border-white/10 p-4">
                            <button type="submit" class="ti-btn ti-btn-primary">
                                <i class="ti ti-device-floppy"></i> Save Other Sections
                            </button>
                        </div>
                    </div>
                </form>

                <!-- 10. VIDEO REVIEWS SECTION -->
                <form action="{{ route('admin.cms.university.home.update', 'video_reviews') }}" method="POST">
                    @csrf
                    <div class="box border border-gray-200 dark:border-white/10 mb-6">
                        <div class="box-header">
                            <h5 class="box-title">10. Video Reviews Section</h5>
                        </div>
                        <div class="box-body">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12 md:col-span-6">
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Heading</label>
                                    <input type="text" name="video_reviews_heading"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $videoReviews['video_reviews_heading'] ?? '' }}">
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Subtitle</label>
                                    <input type="text" name="video_reviews_subtitle"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $videoReviews['video_reviews_subtitle'] ?? '' }}">
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Button
                                        Text</label>
                                    <input type="text" name="video_reviews_button_text"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $videoReviews['video_reviews_button_text'] ?? 'View All' }}">
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white mb-2">Button
                                        Link</label>
                                    <input type="text" name="video_reviews_button_link"
                                        class="py-2 px-3 block w-full border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70"
                                        value="{{ $videoReviews['video_reviews_button_link'] ?? '/reviews' }}">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer text-end border-t border-gray-200 dark:border-white/10 p-4">
                            <button type="submit" class="ti-btn ti-btn-primary">
                                <i class="ti ti-device-floppy"></i> Save Video Reviews
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection