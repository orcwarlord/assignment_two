@extends('layouts.app')

@section('title',  $book->title)

@section('content')
    <div class="flex">
        <p class="opacity-70 text-sm">
            <strong>Created: </strong>{{ $book->created_at->diffForHumans() }}
        </p>
        <p class="opacity-70 text-sm ml-8">
            <strong>Updated: </strong>{{ $book->updated_at->diffForHumans() }}
        </p>
        <a href="{{ route('books.edit', $book) }}" class="btn-link ml-auto">Edit Book</a>
        <form action="{{ route('books.destroy', $book) }}" method="post">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger ml-4"></button>
        </form>
    </div>
    <article class="my-6 p-6 bg-white border-b border-gray-400 shadow-sm sm:rounded-lg">
        <h2 class="font-bold text-4xl text-gray-800 leading-tight">
            {{ $book->title }}
        </h2>
        <p class="mt-6 whitespace-pre-wrap">{{ $book->synopsis }}</p>
        <p class="mt-6">Number of Pages: {{ $book->no_pages }}</p>
        <p class="mt-6">Date Published: {{ $book->date_published }}</p>
        <p class="mt-6">ISBN: {{ $book->isbn }}</p>
    </article>
@endsection


