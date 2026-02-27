<x-layout>
    @foreach($books as $book)
        <div>
            {{ $book->title }}
        </div>
    @endforeach
</x-layout>
