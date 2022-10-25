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
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ route('books.index') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Books</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
                {{-- <h1 class="text-3xl">Books!</h1> --}}

                <h1 class="text-3xl">{{ $title }}</h1>



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
