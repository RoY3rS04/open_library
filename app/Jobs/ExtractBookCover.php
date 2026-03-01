<?php

namespace App\Jobs;

use App\Events\BookMetadataExtracted;
use App\Models\Book;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\File;
use Spatie\PdfToImage\Pdf;

class ExtractBookCover implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected Book $book,
        protected string $pdfPath,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (!$this->book) {
            // TODO: TELL THE USER SOMETHING WENT WRONG
            return;
        }

        $pdf = new Pdf($this->pdfPath);

        $imagePath = base_path('storage/app/public/' . File::name($this->pdfPath)) . '.png';

        $pdf->setPage(1)
            ->setOutputFormat('png')
            ->saveImage($imagePath);

        $image = new \Imagick($imagePath);
        $image->trimImage(0);
        $image->setImagePage(0, 0, 0, 0);
        $image->writeImage($imagePath);

        $this->book->addMedia($imagePath)->toMediaCollection('covers');

        BookMetadataExtracted::dispatch($this->book);
    }
}
