<?php

namespace App\Jobs;

use App\Ai\Agents\BookAnalyzer;
use App\Enums\BookStatus;
use App\Events\BookCreated;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Laravel\Ai\Files\Document;
use Spatie\PdfToImage\Pdf;
use Symfony\Component\Process\Process;

class ExtractBookMetadata implements ShouldQueue
{
    use Queueable;

    public int $timeout = 120;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected BookAnalyzer $bookAnalyzer,
        protected User $user,
        protected string $filePath
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pdfPath = base_path('storage/app/private/' . $this->filePath);

        $outputPath = base_path('storage/app/private/mini/' . $this->filePath);

        $process = new Process([
            'qpdf',
            $pdfPath,
            '--pages',
            $pdfPath,
            '1-10',
            '--',
            $outputPath,
        ]);

        $process->run();

        if (!$process->isSuccessful()) {
            throw new \Exception($process->getErrorOutput());
        }

        $response = $this->bookAnalyzer->prompt(
            'Analyze this attached book and extract its metadata',
            attachments: [
                Document::fromPath($outputPath)
            ],
            model: 'gemini-2.5-flash'
        );

        $data = $response->toArray();

        DB::transaction(function () use ($data, $pdfPath, $outputPath) {

            $authorIds = collect($data['authors'])
                ->map(function ($author) {
                    return Author::firstOrCreate([
                        'first_name' => $author['first_name'],
                        'last_name' => $author['last_name'],
                    ])->id;
                });

            $categoryIds = collect($data['categories'])
                ->map(function ($category) {
                    return Category::firstOrCreate([
                        'name' => $category,
                    ])->id;
                });

            $book = $this->user->submittedBooks()->firstOrCreate([
                'title' => $data['title'],
                'isbn' => $data['isbn'] ?? null,
                'edition' => $data['edition'],
            ],[
                'pages' => $data['pages'],
                'status' => BookStatus::Draft->value,
                'release_date' => Date::parse($data['release_date']),
                'language' => $data['language'],
                'pdf_path' => $pdfPath,
                'synopsis' => $data['synopsis'],
                'publisher' => $data['publisher'],
            ]);

            BookCreated::dispatch($book);

            $book->authors()->sync($authorIds);
            $book->categories()->sync($categoryIds);

            ExtractBookCover::dispatch($book, $outputPath)
                ->afterCommit();
        });
    }
}
