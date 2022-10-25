<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;

class WelcomeController extends Controller
{
    public function index()
    {
        $books = Book::all();



        return view('welcome', [
            'title' => 'Our Books',
	        'books' => $books
        ]);

        // return view('welcome');
    }
}
