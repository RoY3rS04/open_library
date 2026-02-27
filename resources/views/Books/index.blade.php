<x-layout title="Submitted Books" heading="Your submitted books">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        @foreach($books as $book)
            <x-card :book="$book"></x-card>
        @endforeach
    </div>
</x-layout>
