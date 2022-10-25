@extends('layouts.app')

@section('title', 'Showing ' . $book->title)

@section('content')
    <p>{{ $book->synopsis }}</p>
@endsection
