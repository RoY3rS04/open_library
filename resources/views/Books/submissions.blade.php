<x-layout title="Book Submissions" heading="Book Submissions">
    <div class="flex flex-col gap-y-2">
        @foreach($books as $book)
            <div class="flex items-center gap-x-5">
                <p>{{ $book->title }}</p>
            </div>
        @endforeach
    </div>
    {{ $books->links() }}
</x-layout>
