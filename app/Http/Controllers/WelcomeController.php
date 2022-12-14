<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class WelcomeController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('title', 'asc')->paginate(20);

        return view('welcome', [
            'title' => 'Our Books',
	        'books' => $books
        ]);

    }
}
