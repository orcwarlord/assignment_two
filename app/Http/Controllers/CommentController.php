<?php

namespace App\Http\Controllers;


use App\Models\Book;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
        /**
     * Display a form for creating a new comment.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    // public function create(Book $book)
    // {
    //     return view('comments.create', compact('book'));
    // }

    /**
     * Store a newly created comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request, Book $book)
    // {
    //     $validatedData = $request->validate([
    //         'body' => 'required|max:1000',
    //     ]);

    //     $comment = new Comment();
    //     $comment->body = $validatedData['body'];
    //     $comment->book_id = $book->id;
    //     $comment->save();

    //     return redirect()->route('books.show', $book->id);
    // }

    /**
     * Display a listing of comments for the specified book.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function index(Book $book)
    {
        $comments = $book->comments()->paginate();

        return view('books.index', compact('book', 'comments'));
    }

    /**
     * Show the form for editing the specified comment.
     *
     * @param  \App\Book  $book
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    // public function edit(Book $book, Comment $comment)
    // {
    //     return view('comments.edit', compact('book', 'comment'));
    // }

    /**
     * Update the specified comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Book $book, Comment $comment)
    // {
    //     $validatedData = $request->validate([
    //         'body' => 'required|max:1000',
    //     ]);

    //     $comment->body = $validatedData['body'];
    //     $comment->save();

    //     return redirect()->route('books.show', $book->id);
    // }

    /**
     * Remove the specified comment from storage.
     *
     * @param  \App\Book  $book
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Book $book, Comment $comment)
    // {
    //     $comment->delete();

    //     return redirect();

    // }
}
