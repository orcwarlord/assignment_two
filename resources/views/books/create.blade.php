@extends('layouts.app')

@section('title', 'Add a book')

@section('content')



    <article class="my-6 p-6 bg-white border-b border-gray-400 shadow-sm sm:rounded-lg">

        {{-- Errors are under the fields --}}
        {{-- @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach --}}
        <form action="{{ route('books.store') }}" method="post">
            @csrf
            <x-input
                type="text"
                name="title"
                field="title"
                placeholder="Title"
                class="w-full"
                autocomplete="off"
                :value="@old('title')"
                ></x-input>


            <x-textarea
                name="synopsis"
                field="synopsis"
                id=""
                rows="10"
                placeholder="Add the synopsis"
                class="w-full mt-6"
                :value="@old('synopsis')"></x-textarea>

            <x-input-label for="author" class="mt-6">Author</x-input-label>
            <x-input
                type="text"
                name="author"
                field="author"
                min="1"
                :value="@old('author')"
                aria-placeholder="author"></x-input>



            <x-input-label for="no_pages" class="mt-6">Number of Pages</x-input-label>
            <x-input
                type="number"
                name="no_pages"
                field="no_pages"
                min="1"
                :value="@old('no_pages')"
                aria-placeholder="Number of Pages"></x-input>


            <x-input-label for="published_date" class="mt-6">Date of Publication</x-input-label>
            <x-input
                type="date"
                name="published_date"
                field="published_date"
                aria-placeholder="Date of Publication"
                :value="@old('published_date')"></x-input>

            <x-input-label for="isbn" class="mt-6">ISBN 13</x-input-label>
            <x-input
                type="text"
                name="isbn"
                field="isbn"
                id=""
                placeholder="XXXXXXXXXXXXX"
                aria-placeholder="13 digit ISBN number"
                :value="@old('isbn')" ></x-input>

            <x-input-label for="cover_image" class="mt-6">Cover Image Link</x-input-label>
            <x-input
                type="text"
                name="cover_image"
                field="cover_image"
                id=""
                placeholder="Enter full url for the image"
                :value="@old('cover_image')" ></x-input>

            <br/>
            <x-button class="mt-6 block">Save Book</x-button>
        </form>
    </article>



@endsection
