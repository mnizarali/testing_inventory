<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') - SPP Stock</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/dist/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/dist/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/modules/weather-icon/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/modules/weather-icon/css/weather-icons-wind.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/modules/summernote/summernote-bs4.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/custom.css') }}">
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            @include('components.navigation')
            @include('components.sidebar')
            <div class="main-content">
                @yield('content')
            </div>

            @include('components.footer')
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/dist/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/stisla.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('assets/dist/modules/simple-weather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/chart.min.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

      <!-- JS Libraies -->
    <script src="{{ asset('assets/dist/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Modal JS File -->
    <script src="{{ asset('assets/dist/js/page/bootstrap-modal.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/dist/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/dist/js/custom.js') }}"></script>

    @yield("scripts")
</body>

</html>
