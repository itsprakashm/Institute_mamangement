<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Manpreet Bhatia Classes - Admin Dashboard">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Manpreet Bhatia Classes - Admin')</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/images/logo-mbc.jpg') }}" sizes="16x16">
  <!-- remix icon font css  -->
  <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}">
  <!-- BootStrap css -->
  <link rel="stylesheet" href="{{ asset('assets/css/lib/bootstrap.min.css') }}">
  <!-- Apex Chart css -->
  <link rel="stylesheet" href="{{ asset('assets/css/lib/apexcharts.css') }}">
  <!-- Data Table css -->
  <link rel="stylesheet" href="{{ asset('assets/css/lib/dataTables.min.css') }}">
  <!-- Date picker css -->
  <link rel="stylesheet" href="{{ asset('assets/css/lib/flatpickr.min.css') }}">
  <!-- Calendar css -->
  <link rel="stylesheet" href="{{ asset('assets/css/lib/full-calendar.css') }}">
  <!-- calendar -->
  <link rel="stylesheet" href="{{ asset('assets/css/lib/calendar.css') }}">
  <!-- main css -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  @yield('styles')
</head>

<body>

  <!-- Theme Customization -->
  @include('partials.theme-customizer')

  <div class="overlay bg-black bg-opacity-50 w-100 h-100 position-fixed z-9 visibility-hidden opacity-0 duration-300">
  </div>

  <!-- Sidebar -->
  @include('partials.sidebar')

  <main class="dashboard-main">
    <!-- Header -->
    @include('partials.header')

    <div class="dashboard-main-body">
      @yield('breadcrumb')
      @yield('content')
    </div>

    <!-- Footer -->
    @include('partials.footer')
  </main>

  <!-- Scripts -->
  @include('partials.scripts')
  @yield('page-scripts')

</body>

</html>
