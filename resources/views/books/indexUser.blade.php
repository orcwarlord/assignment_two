@extends('layouts.app')

@section('title', 'BonusLibris Home')

@section('content')

    <x-alert-success>
        {{ session('success') }}
    </x-alert-success>

    <form action="{{ route('books.index') }}" method="GET">
        <x-input class="w-4/5" type="text" name="search" placeholder="Search..."></x-input>
        <button class="btn btn-link" type="submit">Search</button>
    </form>

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


            <div class="flex flex-col justify-between">
                <p>{{ $book->comments->count() }} comments</p>
                <p class="text-center"><a href="{{ route('books.show', $book) }}" class="btn-link btn-lg mb-2 text-center">Book Details</a></p>

            </div>

        </article>

    @endforeach

    {{ $books->links()}}

@endsection
