@extends('layouts.app')

@section('title', 'Edit a book')

@section('content')



    <article class="my-6 p-6 bg-white border-b border-gray-400 shadow-sm sm:rounded-lg">

        {{-- Errors are under the fields --}}
        {{-- @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach --}}
        <form action="{{ route('books.update',  $book) }}" method="post">
            @method('put')
            @csrf
            <x-input
                type="text"
                name="title"
                field="title"
                placeholder="Title"
                class="w-full"
                autocomplete="off"
                :value="@old('title', $book->title)"
                ></x-input>


            <x-textarea
                name="synopsis"
                field="synopsis"
                id=""
                rows="10"
                placeholder="Add the synopsis"
                class="w-full mt-6"
                :value="@old('synopsis', $book->synopsis)"></x-textarea>


            <x-input-label for="isbn" class="mt-6">ISBN 13</x-input-label>
            <x-input
                type="text"
                name="isbn"
                field="isbn"
                id=""
                placeholder="XXXXXXXXXXXXX"
                aria-placeholder="13 digit ISBN number"
                :value="@old('isbn', $book->isbn)" ></x-input>


            <x-input-label for="no_pages" class="mt-6">Number of Pages</x-input-label>
            <x-input
                type="number"
                name="no_pages"
                field="no_pages"
                min="1"
                :value="@old('no_pages', $book->no_pages)"
                aria-placeholder="Number of Pages"></x-input>


            <x-input-label for="published_date" class="mt-6">Date of Publication</x-input-label>
            <x-input
                type="date"
                name="published_date"
                field="published_date"
                aria-placeholder="Date of Publication"
                :value="@old('published_date', $book->published_date)"></x-input>
            <br/>
            <x-button class="mt-6 block">Save Book</x-button>
        </form>
    </article>



@endsection
