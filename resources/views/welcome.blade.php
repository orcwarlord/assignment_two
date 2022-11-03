<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BonusLibre') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-emerald-100">
        <!-- Page Heading -->

        <div class="w-full bg-white">
            <header class="bg-white shadow-sm max-w-screen-xl mx-auto">
                <nav class="bg-white shadow flex justify-between py-4">
                        <!-- Logo -->
                    <div class="shrink-0 flex  items-center">
                        <a href="{{ route('books.index') }}">
                            <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                        </a>
                        <h1 class="ml-5 text-lg md:text-xl lg:text-2xl">BonusLibris</h1>
                    </div>
                    <div class="relative flex items-top justify-center h-12 bg-emerald-40 dark:bg-gray-900 sm:items-center  sm:pt-0">
                        @if (Route::has('login'))
                            <div class=" ">
                                @auth
                                    <a href="{{ route('books.index') }}" class="btn-link ">Books</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn-link mr-1">Log in</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn-link">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </nav>
                <h1 class="text-3xl mt-5 pb-5 px-4">{{ $title }}</h1>
            </header>
        </div>
        <div class="min-h-screen bg-emerald-100 max-w-screen-xl mx-auto">


        {{-- <!-- Page Heading -->

        <div class="w-full bg-white">
            <header class="bg-white shadow ">
            <nav class="bg-white shadow flex justify-between py-4">
                    <!-- Logo -->
                <div class="shrink-0 flex  items-center">
                    <a href="{{ route('books.index') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                    <h1 class="ml-5 text-lg md:text-xl lg:text-2xl">BonusLibris</h1>
                </div>
                <div class="relative flex items-top justify-center h-12 bg-emerald-40 dark:bg-gray-900 sm:items-center  sm:pt-0">
                    @if (Route::has('login'))
                        <div class=" ">
                            @auth
                                <a href="{{ route('books.index') }}" class="btn-link ">Books</a>
                            @else
                                <a href="{{ route('login') }}" class="btn-link mr-1">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn-link">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </nav>
            <h1 class="text-3xl mt-5 pb-5 px-4">{{ $title }}</h1>


                </header>
        </div> --}}




        <section class="relative  min-h-screen bg-emerald-20 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

            <div class="grid gap-x-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

                @foreach ($books as $book)
                    <article class="bg-white p-3 shadow-lg">
                        <p><img class="w-full " src="{{ $book->cover_image }}" alt=""></p>
                        <h2 class="text-lg md:text-xl lg:text-2xl uppercase">{{ $book->title }}</h2>
                        <p><span class="inline-block w-20 font-semibold">Author:</span>{{ $book->author }}</p>
                        <p>{{ Str::limit($book->synopsis, 200) }}</p>
                    </article>
                @endforeach


            </div>
            {{ $books->links()}}
        </section>
        </div>
    </body>
</html>
