@extends('layouts.app')

@section('title',  $book->title)

@section('content')
    <x-alert-success>
       {{ session('success')}}
    </x-alert-success>

    <div class="flex flex-col lg:flex-row">
        <div class="flex">
            <p class="opacity-70 text-sm "><strong>Created by: </strong>{{ $book->user->name }}</p>
            <p class="opacity-70 text-sm ml-8">
                <strong>Created: </strong>{{ $book->created_at->diffForHumans() }}
            </p>
            <p class="opacity-70 text-sm ml-8">
                <strong>Updated: </strong>{{ $book->updated_at->diffForHumans() }}
            </p>
        </div>
    </div>
    <article class="my-6 p-6 bg-white border-b border-gray-400 shadow-sm sm:rounded-lg">
        <div class="flex flex-col md:flex-row justify-between">
            <h2 class="font-bold text-4xl text-gray-800 leading-tight">
                {{ $book->title }}
            </h2>
            <div class="flex">
                <p class="pr-0.5">
                            <form action="{{ route('books.uplike', $book->uuid) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-small hover:text-orange-700">
                                    <span class="fa-stack ">
                                        <i class="fas fa-circle fa-stack-2x text-orange-500 hover:text-orange-700"></i>
                                        <i class="fas fa-thumbs-up fa-stack-1x"></i>
                                    </span>
                                </button>
                                <span class="pr-4 -ml-4">{{ $book->up_likes }}</span>
                            </form>

                        </p>
                        <span class="w-5"></span>
                        <p class="pr-0.5 bg-slate-300">
                        <form action="{{ route('books.downlike', $book->uuid) }}" method="POST">
                            @csrf

                            <button type="submit" class="btn  hover:text-orange-700">
                                <span class="fa-stack ">
                                    <i class="fas fa-circle fa-stack-2x text-orange-500 "></i>
                                    <i class="fas fa-thumbs-down fa-stack-1x"></i>
                                </span>

                            </button>
                            <span class="pr-4 -ml-4 ">{{ $book->down_likes }}</span>
                        </form>
                        </p>
            </div>
        </div>

        <div class="grid grid-cols-1  md:grid-cols-[1fr_2fr] lg:grid-cols-[1fr_3fr]"" >

                <p class='flex items-center justify-center w-full  h-auto p-5'><a href="{{ route('books.show', $book)}}"><img src="{{ $book->cover_image }}" width="500px" alt="{{ $book->title }} book cover" class=""></a></p>


            <div>
                <p class="mt-6 whitespace-pre-wrap">{{ $book->synopsis }}</p>
                <p class="mt-6"><span class="inline-block w-40 font-semibold">Author: </span>{{ $book->author }}</p>
                <p class="mt-6"><span class="inline-block w-40 font-semibold">Number of Pages: </span>{{ $book->no_pages }}</p>
                <p class="mt-6"><span class="inline-block w-40 font-semibold">Date Published: </span>{{ ($book->published_date)->format('jS F Y') }}</p>
                <p class="mt-6"><span class="inline-block w-40 font-semibold">ISBN: </span>{{ $book->isbn }}</p>
            </div>
        </div>
        <form action="/books/{{ $book->uuid }}/comments" method="POST">
            @csrf
            <label for="body">Comment:</label><br>
            <x-textarea id="body" name="body" rows="5" placeholder="Add a comment" class="w-full mt-2"></x-textarea><br>
            <input type="hidden" name="book_id" value="{{ $book->id }}" />
            <button type="submit" class="btn-lg mb-2 btn-link">Submit</button>
        </form>


        @foreach($comments as $comment)
            <div class="comment my-3 p-5 rounded bg-slate-100 drop-shadow-md">
                <div class="flex justify-between">


                <p class="font-semibold">{{ $comment->user->name }}</p>
                <p class="opacity-70  ml-8">
                        {{ $comment->created_at->diffForHumans() }}
                    </p>


                </div>
                <div class="flex justify-between">
                    <p>{{ $comment->body }}</p>
                    @if (Auth::user() && Auth::user()->id === $comment->user_id)
                        <form action="/books/{{ $book->uuid }}/comments/{{ $comment->id }}" method="POST">
                        {{-- <a class="btn btn-blue"
                        href="{{ route('visitors.edit', $visitor->id) }}">Edit</a> --}}
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-red btn-
                        link ml-5">Delete</button>
                        </form>
                    @endif
                </div>
            </div>


        @endforeach


        <form action="/books/{{ $book->uuid }}/comments" method="POST">
            @csrf
            <label for="body">Comment:</label><br>
            <x-textarea id="body" name="body" rows="5" placeholder="Add a comment" class="w-full mt-2"></x-textarea><br>
            <input type="hidden" name="book_id" value="{{ $book->id }}" />
            <button type="submit" class="btn-lg mb-2 btn-link">Submit</button>
        </form>


        @foreach($comments as $comment)
            <div class="comment my-3 p-5 rounded bg-slate-100 drop-shadow-md">
                <div class="flex justify-between">


                <p class="font-semibold">{{ $comment->user->name }}</p>
                <p class="opacity-70  ml-8">
                        {{ $comment->created_at->diffForHumans() }}
                    </p>


                </div>
                <div class="flex justify-between">
                    <p>{{ $comment->body }}</p>
                    @if (Auth::user() && Auth::user()->id === $comment->user_id)
                        <form action="/books/{{ $book->uuid }}/comments/{{ $comment->id }}" method="POST">
                        {{-- <a class="btn btn-blue"
                        href="{{ route('visitors.edit', $visitor->id) }}">Edit</a> --}}
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-red btn-
                        link ml-5">Delete</button>
                        </form>
                    @endif
                </div>
            </div>


        @endforeach


    </article>
    {{-- <div class="flex justify-between w-full">
            <a href="{{ route('books.index', $book) }}" class="btn-link ">Back to Books</a>
            <a href="{{ route('books.edit', $book) }}" class="btn-link ">Edit Book</a>
            <form action="{{ route('books.destroy', $book) }}" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure you want to delete this book?')">Delete Book</button>
            </form>
        </div> --}}

@endsection


