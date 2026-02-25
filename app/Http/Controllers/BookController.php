<?php

namespace App\Http\Controllers;

use App\Ai\Agents\BookAnalyzer;
use App\Http\Requests\Books\BookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View {
        return view('books.index', [
            'books' => Auth::user()->books
        ]);
    }

    public function create(): View {
        return view('books.create');
    }

    public function store(Request $request) {
        $path = $request->file('file')
            ->storeAs('books', uuid_create() . '.pdf');

        //TODO: MAKE THE BOOKANALYZER WORK IN A QUEUE
        $response = (new BookAnalyzer)->prompt(
            'Analyze this attached book and extract its metadata',
            attachments: [
                $request->file('file')
            ]
        );

        return $response;
    }
}
