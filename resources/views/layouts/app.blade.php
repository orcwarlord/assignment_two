<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BonusLibre') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-emerald-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            {{-- @if (isset($header)) --}}
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
                        <h1 class="text-3xl mt-5 pb-5">@yield('title')</h1>
                        {{-- {{ $title }} --}}
                    </div>
                </header>
            {{-- @endif --}}

            <!-- Page Content -->
                <section class="content py-12">
                    <div class="container mx-auto max-w-7xl sm:px-6 lg:px-8">
                        @yield('content')
                    </div>
                </section>



            {{-- <main>
                {{ $content }}
            </main> --}}
        </div>
    </body>
</html>

{{-- References
    Balasa, S. (2022). Laravel 9.0 Essential Training. Linkedin Learning. https://www.linkedin.com/learning/laravel-9-0-essential-training/
    Install Tailwind CSS with Laravel. (2022).  Tailwind CSS. Retrieved 14/10/2022 from https://tailwindcss.com/docs/guides/laravel
    Laravel Breeze. (2022).  Laravel. https://laravel.com/docs/9.x/starter-kits#laravel-breeze


    --}}
