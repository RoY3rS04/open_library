<x-layout title="Top Books" heading="Top Books">
    @foreach($books as $book)
        <div>
            {{ $book->title }}
        </div>
    @endforeach
</x-layout>
