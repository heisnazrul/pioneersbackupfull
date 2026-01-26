    <aside class="app-sidebar" id="sidebar">

        <!-- Start::main-sidebar-header -->
        <div class="main-sidebar-header">
            <a href="{{ route('student.dashboard') }}" class="header-logo">
                <img src="{{ asset('assets/img/brand-logos/logo.png') }}" alt="logo" class="main-logo desktop-logo">
                <img src="{{ asset('assets/img/brand-logos/toggle-logo.png') }}" alt="logo" class="main-logo toggle-logo">
                <img src="{{ asset('assets/img/brand-logos/logo.png') }}" alt="logo" class="main-logo desktop-dark bg-white">
                <img src="{{ asset('assets/img/brand-logos/toggle-dark.png') }}" alt="logo" class="main-logo toggle-dark">
            </a>
        </div>
        <!-- End::main-sidebar-header -->

        <!-- Start::main-sidebar -->
        <div class="main-sidebar" id="sidebar-scroll">

            <!-- Start::nav -->
            <nav class="main-menu-container nav nav-pills flex-column sub-open">
                <div class="slide-left" id="slide-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                    </svg>
                </div>
                <ul class="main-menu">
                    <li class="slide__category"><span class="category-name">Overview</span></li>
                    <li class="slide">
                        <a href="{{ route('student.dashboard') }}" class="side-menu__item">
                            <i class="ri-home-8-line side-menu__icon"></i>
                            <span class="side-menu__label">Dashboard</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- End::nav -->

        </div>
        <!-- End::main-sidebar -->

    </aside>
