<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $userLevel = Auth::user()->userlevel;
        if ($userLevel === 'user') {
            return view('books.indexUser');
        }
        else {
            $books = Book::orderBy('created_at', 'desc')->paginate(20);
            //Most recently created
            // dd($books);

            // Using the helper method (same as following example.
            return view('books.indexAdmin')->with('books', $books);

            // return view('books.index', [
            //     'books' => $books
            // ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        //Validate fields
        $request->validate([
            'title' => 'required|max:200',
            'synopsis' => 'required',
            'no_pages' => 'min:1|integer|nullable',
            'isbn' => 'size:13|nullable',
            'published_date' => 'required'
        ]);

        Book::create([
            'uuid' => Str::uuid(),
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'no_pages' => $request->no_pages,
            'isbn' => $request->isbn,
            'published_date' => $request->published_date
        ]);

        return to_route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('books.show', [
            'book' => $book
        ]);
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Book  $book
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($uuid)
    // {
    //     $book = Book::where('uuid', $uuid);
    //     return view('books.show')->with('book', $book);
    // }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.edit')->with('book', $book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //Validate fields
        $request->validate([
            'title' => 'required|max:200',
            'synopsis' => 'required',
            'no_pages' => 'min:1|integer|nullable',
            'isbn' => 'size:13|nullable',
            'published_date' => 'required'
        ]);

        $book->update([
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'no_pages' => $request->no_pages,
            'isbn' => $request->isbn,
            'published_date' => $request->published_date

        ]);

        return to_route('books.show', $book)->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return to_route('books.index')->with('success', 'Note deleted successfully');
    }


}
