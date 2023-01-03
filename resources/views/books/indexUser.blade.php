@extends('layouts.app')

@section('title', 'BonusLibris Home')

@section('content')

    <x-alert-success>
        {{ session('success') }}
    </x-alert-success>

    <form action="{{ route('books.index') }}" id="search" method="GET" class="flex justify-between">
        @csrf

        <x-input class="w-4/5" type="text" name="search" placeholder="Search..." ></x-input>
        <button class="btn btn-link" type="submit">Search</button>
        <button class="btn btn-red" onclick="resetForm()">Clear</button>

    </form>
    @if ($search <> "")
        <p>You searched for: {{ $search }}
    @endif



    @foreach ($books as $book)
        <article class="my-6 p-6 bg-white border-b border-gray-400 shadow-md sm:rounded-lg flex flex-col sm:flex-row">
            <p class='flex items-center justify-center w-full sm:w-1/4 md:w-1/6 lg:w-1/12 h-auto'><a href="{{ route('books.show', $book)}}"><img src="{{ $book->cover_image }}" width="500px" alt="{{ $book->title }} book cover" class=""></a></p>
            <div class="ml-0 sm:ml-5 md:ml-10 w-full">
                <h3 class="font-bold text-2xl"><a href="{{ route('books.show', $book)}}">{{$book->title}}</a></h3>
                <p class="mt-2">{{ Str::limit($book->synopsis, 200) }}</p>
                <p class="mt-2"><span class="inline-block w-40 font-semibold">Author:</span>{{ $book->author }}</p>
                <p class="mt-2"><span class="inline-block w-40 font-semibold">Number of Pages:</span>{{ $book->no_pages }}</p>
                <p class="mt-2"><span class="inline-block w-40 font-semibold">Date Published:</span>{{ ($book->published_date)->format('jS F Y') }}</p>
                <p class="mt-2"><span class="inline-block w-40 font-semibold">ISBN:</span>{{ $book->isbn }}</p>
                <span class="block opacity-70 text-sm mt-4">Updated: {{ $book->updated_at->diffForHumans()}}. Created: {{ $book->created_at->diffForHumans()}}</span>

            </div>

            <div><p>
                Up votes: {{ $book->up_votes }}<br>
                Down votes: {{ $book->down_votes }}
                </p>

                <form action="{{ route('books.upvote', $book->id) }}" method="POST">
                @csrf

                <button type="submit" class="btn">Up Vote</button>
                </form>

                <form action="{{ route('books.downvote', $book->id) }}" method="POST">
                @csrf

                <button type="submit" class="btn">Down Vote</a>
                </form>
            </div>
            <div class="flex flex-col justify-between">
                <p>{{ $book->comments->count() }} comments</p>
                <p class="text-center"><a href="{{ route('books.show', $book) }}" class="btn-link btn-lg mb-2 text-center">Book Details</a></p>

            </div>

        </article>

    @endforeach

    {{ $books->links()}}


    <script>


        function resetForm(){
            let $search = document.getElementById('search');
            // console.log($search);
            // return;
            $search.value="";
            // $search.submit();
        }
    </script>
@endsection
