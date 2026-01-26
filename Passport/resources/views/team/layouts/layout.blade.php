<!DOCTYPE html>
<html lang="en" dir="ltr" class="light" data-header-styles="light" data-menu-styles="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Dashboard</title>
    <meta name="description" content="Team Dashboard">
    <meta name="keywords" content="team dashboard">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/brand-logos/favicon.ico') }}">

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/simplebar/simplebar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/nano.min.css') }}">
</head>

<body>

  <div class="page">

    @include('team.layouts.sidebar')
    @include('team.layouts.header')

    <div class="content">
        <div class="main-content">
            @yield('content') <!-- Content will be inserted here -->
        </div>
    </div>

    @include('team.layouts.headersearch_modal')
    @include('team.layouts.footer')

  </div>

  <!-- Scripts -->
  <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/js/index-12.js') }}"></script>

  <!-- Scroll To Top -->
  <div class="scrollToTop">
      <span class="arrow"><i class="ri-arrow-up-s-fill text-xl"></i></span>
  </div>

  <div id="responsive-overlay"></div>

  <!-- Popper.js -->
  <script src="{{ asset('assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>

  <!-- Pickr JS -->
  <script src="{{ asset('assets/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>

  <!-- Custom JS Files -->
  <script src="{{ asset('assets/js/defaultmenu.js') }}"></script>
  <script src="{{ asset('assets/js/sticky.js') }}"></script>
  <script src="{{ asset('assets/js/switch.js') }}"></script>
  <script src="{{ asset('assets/libs/preline/preline.js') }}"></script>
  <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <script src="{{ asset('assets/js/custom-switcher.js') }}"></script>

</body>
</html>
