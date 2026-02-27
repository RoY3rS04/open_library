<?php

namespace App\Http\Controllers;

use App\Ai\Agents\BookAnalyzer;
use App\Http\Requests\Books\BookRequest;
use App\Jobs\ExtractBookMetadata;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View {
        return view('Books.index', [
            'books' => Auth::user()->books
        ]);
    }

    public function create(): View {
        return view('Books.create');
    }

    public function store(BookRequest $request) {
        $path = $request->file('file')
            ->storeAs('books', uuid_create() . '.pdf');

        ExtractBookMetadata::dispatch(
            new BookAnalyzer(),
            Auth::user(),
            $path
        );

        return back()->with('success', 'Your book is being processed.');
    }

    public function show(Book $book): View {

        $book->load([
            'authors',
            'categories',
            'media'
        ]);

        return view('Books.show', [
            'book' => $book
        ]);

    }
}
