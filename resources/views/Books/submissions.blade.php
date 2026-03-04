<x-layout title="Book Submissions" heading="Book Submissions">
    <div class="grid grid-cols-2 gap-5">
        @foreach($books as $book)
            <x-card :book="$book"></x-card>
        @endforeach
    </div>
    {{ $books->links() }}
</x-layout>
