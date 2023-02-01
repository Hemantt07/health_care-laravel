<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <?php
            date_default_timezone_set('Asia/Kolkata') 
                
        ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Health-Care @yield('title')</title>
        <link rel="icon" href="{{ asset('assets/img/icon.jpg') }}">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('assets/css/maicons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel/css/owl.carousel.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" />
        <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
  
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="back-to-top"></div>
        <div class="min-h-screen bg-gray-100">
            <main>
                @yield('content')
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    
        <script>

        $(document).ready(function () {

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#calendar').fullCalendar();
        });

        </script>

    </body>
</html>
