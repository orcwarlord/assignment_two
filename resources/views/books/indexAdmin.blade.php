@extends('layouts.app')

@section('title', 'All books')

@section('content')

    {{-- @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif --}}

    <x-alert-success>
        {{ session('success') }}
    </x-alert-success>

    <a href="{{ route('books.create') }}" class="btn-link btn-lg mb-2">+ Add a Book</a>

    @foreach ($books as $book)
        <article class="my-6 p-6 bg-white border-b border-gray-400 shadow-sm sm:rounded-lg flex flex-col sm:flex-row">
            <p class='flex items-center justify-center w-full sm:w-1/4 md:w-1/6 lg:w-1/12 h-auto'><a href="{{ route('books.show', $book)}}"><img src="{{ $book->cover_image }}" width="500px" alt="{{ $book->title }} book cover" class=""></a></p>
            <div class="ml-0 sm:ml-5 md:ml-10">
                <h3 class="font-bold text-2xl"><a href="{{ route('books.show', $book)}}">{{$book->title}}</a></h3>
                <p class="mt-2">{{ Str::limit($book->synopsis, 200) }}</p>
                <p class="mt-2"><span class="inline-block w-40 font-semibold">Author:</span>{{ $book->author }}</p>
                <p class="mt-2"><span class="inline-block w-40 font-semibold">Number of Pages:</span>{{ $book->no_pages }}</p>
                <p class="mt-2"><span class="inline-block w-40 font-semibold">Date Published:</span>{{ ($book->published_date)->format('jS F Y') }}</p>
                <p class="mt-2"><span class="inline-block w-40 font-semibold">ISBN:</span>{{ $book->isbn }}</p>
                <span class="block opacity-70 text-sm mt-4">Updated: {{ $book->updated_at->diffForHumans()}}. Created: {{ $book->created_at->diffForHumans()}}</span>
            </div>
        </article>

    @endforeach

    {{ $books->links()}}

@endsection
