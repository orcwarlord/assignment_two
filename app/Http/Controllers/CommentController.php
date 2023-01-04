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
    public function store(Request $request, Book $book)
    {

        // Validate the request data
        $request->validate([
            'body' => 'required|min:10|max:1000',
        ]);

        // Create a new comment instance
        $comment = new Comment();
        $comment->body = $request->input('body');
        $comment->book_id = $book->id;
        $comment->user_id = auth()->id();
        // $comment->user_id = 1;

        // Save the comment to the database
        $comment->save();

        // Redirect the user back to the book page
        return redirect()->route('books.show', $book);

    }

    /**
     * Display a listing of comments for the specified book.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    // public function index(Book $book)
    // {
    //     $comments = $book->comments()->paginate();

    //     return view('books.index', compact('book', 'comments'));
    // }

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


    /**
     * Remove the specified comment from storage.
     *
     * @param  \App\Book  $book
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, Comment $comment)
    {
        $comment->delete();

        return redirect()->route('books.show', $book);

    }
}
