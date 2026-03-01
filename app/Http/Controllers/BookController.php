<?php

namespace App\Http\Controllers;

use App\Ai\Agents\BookAnalyzer;
use App\Enums\BookStatus;
use App\Http\Requests\Books\BookRequest;
use App\Http\Requests\UpdateBookMetadataRequest;
use App\Jobs\ExtractBookMetadata;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use function PHPSTORM_META\map;

class BookController extends Controller
{
    public function index(Request $request): View {

        $request->merge([
            'status' => $request->input('status', BookStatus::Draft->value)
        ]);

        $request->validate([
           'status' => [
               'required',
               new Enum(BookStatus::class),
           ],
        ]);

        $books = Auth::user()->submittedBooks()
            ->where('status', $request->status)
            ->paginate(10);

        return view('Books.index', [
            'books' => $books,
            'status' => $request->status,
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

    public function edit(Book $book): View {
        return view('Books.edit', [
            'book' => $book
        ]);
    }

    public function update(UpdateBookMetadataRequest $request, Book $book): RedirectResponse {

        $validated = $request->validated();

        $authors = array_map(
            function ($author) {
                $arr = explode(' ', $author);
                return [
                    'first_name' => trim($arr[0]),
                    'last_name' => trim($arr[1]),
                ];
            },
            explode(', ', $validated['authors'])
        );

        $categories = array_map(
            fn ($category) => ['name' => trim($category)],
            explode(', ', $validated['categories'])
        );

        // TODO: FIND A WAY TO AVOID N QUERIES

        \DB::transaction(function () use ($book, $authors, $categories, $validated) {

            $authorIds = collect($authors)
                ->map(function ($author) {
                    return Author::firstOrCreate([
                        'first_name' => $author['first_name'],
                        'last_name' => $author['last_name'],
                    ])->id;
                });

            $categoryIds = collect($categories)
                ->map(function ($category) {
                    return Category::firstOrCreate([
                        'name' => $category,
                    ])->id;
                });

            $book->update($validated);

            $book->authors()->sync($authorIds);
            $book->categories()->sync($categoryIds);
        });

        return redirect('books/' . $book->id)->with('success', 'Your book was updated.');
    }

    public function download(Book $book): BinaryFileResponse {

        $book->downloads++;
        $book->save();

        return response()->download($book->pdf_path);
    }

    public function top(): View {

        $topBooks = Book::query()
            ->orderBy('downloads', 'desc')
            ->limit(10)
        ->get();

        return view('Books.top', [
            'books' => $topBooks
        ]);
    }
}
