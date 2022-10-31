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
        <article class="my-6 p-6 bg-white border-b border-gray-400 shadow-sm sm:rounded-lg">
            <h3 class="font-bold text-2xl"><a href="{{ route('books.show', $book)}}">{{$book->title}}</a></h3>
            <p class="mt-2">{{ Str::limit($book->synopsis, 200) }}</p>
            <span class="block opacity-70 text-sm mt-4">Updated: {{ $book->updated_at->diffForHumans()}}. Created: {{ $book->created_at->diffForHumans()}}</span>
        </article>

    @endforeach

    {{ $books->links()}}

@endsection
