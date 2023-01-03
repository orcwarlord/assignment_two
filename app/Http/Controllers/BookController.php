<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Like;
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
    public function index(Request $request)
    {
        $search = $request->get('search');

        // dd($search);
        $userLevel = Auth::user()->userlevel;

        $books = Book::when($request->search, function ($query) use ($request) {
            return $query->where('title', 'like', '%' . $request->search . '%')->orWhere('author', 'like', '%' . $request->search . '%');
        })
        ->withLikes()
        ->paginate(20);
        // User functionality to be implemented
        if ($userLevel === 'user') {
            return view('books.indexUser', compact('books', 'search'));




        }
        else {
            //Sort by most recently created


            // Using the helper method (same as following example.
            return view('books.indexAdmin')->with('books', $books);
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
        $userId = Auth::user()->id;
        $urlRegex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        //Validate fields
        $request->validate([
            'title' => 'required|max:200',
            'synopsis' => 'required',
            'no_pages' => 'min:1|integer|nullable',
            'isbn' => 'size:13|nullable',
            'published_date' => 'required',
            // 'cover_image' => 'url'. $urlRegex
        ]);

        Book::create([
            'uuid' => Str::uuid(),
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'no_pages' => $request->no_pages,
            'isbn' => $request->isbn,
            'published_date' => $request->published_date,
            'author' => $request->author,
            'user_id' => $userId,
            'cover_image' => $request->cover_image
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
        $comments = $book-> comments->sortByDesc('created_at')->values()->all();
        $likes = $book->likes->values()->all();

        return view('books.show', compact('book', 'comments', 'likes'));

    }

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
        $userId = Auth::user()->id;
        $urlRegex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        //Validate fields
        $request->validate([
            'title' => 'required|max:200',
            'synopsis' => 'required',
            'no_pages' => 'min:1|integer|nullable',
            'isbn' => 'size:13|nullable',
            'published_date' => 'required',
            // 'cover_image' => 'regex'.$urlRegex
        ]);

        $book->update([
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'no_pages' => $request->no_pages,
            'isbn' => $request->isbn,
            'published_date' => $request->published_date,
            'author' => $request->author,
            'user_id' => $userId,
            'cover_image' => $request->cover_image

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

    protected function _likeExists($likeData)
    {
        return Like::where([
            'book_id' => $likeData['book_id'],
            'user_id' => $likeData['user_id']
        ])->exists();
    }

    public function upLike(Book $book)
    {
        if ($this->_likeExists([
            'book_id' => $book->id,
            'user_id' => Auth::user()->id
        ])) {
            return redirect()->route('books.index')
            ->with('success', 'You have already liked for this book.');
        }

        $book->addUpLike(Auth::user());

        return redirect()->route('books.index')
        ->with('success', 'Book up liked');
    }

    public function downLike(Book $book)
    {
        if ($this->_likeExists([
            'book_id' => $book->id,
            'user_id' => Auth::user()->id
        ])) {
            return redirect()->route('books.index')
            ->with('success', 'You have already liked for this book.');
        }

        $book->addDownLike(Auth::user());

        return redirect()->route('books.index')
        ->with('success', 'Book down liked');
    }

}
