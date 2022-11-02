<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="antialiased">

        <div class="relative flex items-top justify-center h-12 bg-emerald-10 dark:bg-gray-900 sm:items-center  sm:pt-0">
            @if (Route::has('login'))
                <div class=" fixed top-0 right-0 px-6 py-2 sm:block">
                    @auth
                        <a href="{{ route('books.index') }}" class="btn-link">Books</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-link">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-link">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
                {{-- <h1 class="text-3xl">Books!</h1> --}}
        </div>
        <h1 class="text-3xl">{{ $title }}</h1>

        <div class="relative flex items-top justify-center min-h-screen bg-emerald-20 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

            <div class="grid grid-cols-3">



                @foreach ($books as $book)
                    <section>
                        <h2 class="text-2xl uppercase">{{ $book->title }}</h2>

                        <p>{{ Str::limit($book->synopsis, 200) }}</p>
                    </section>
                @endforeach
                {{ $books->links()}}

            </div>
        </div>

    </body>
</html>
