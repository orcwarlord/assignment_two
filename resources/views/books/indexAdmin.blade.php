@extends('layouts.app')

@section('title', 'All books')

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @foreach ($books as $book)
        <article>
            <h3><a href="{{ route('books.show', $book->id)}}">{{$book->title}}</a></h3>
        </article>

    @endforeach

@endsection
