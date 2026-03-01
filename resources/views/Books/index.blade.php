@php use App\Enums\BookStatus; @endphp
<x-layout title="Submitted Books" heading="Your submitted books">
    <x-slot:files>
        @vite(['resources/js/book_status_filter.js'])
    </x-slot:files>
    <x-slot:action>
        <form action="/books" method="GET">
            <select id="filter" class="p-2 border-2 border-black" name="status">
                @foreach(BookStatus::cases() as $bookStatus)
                    <option {{ $status === $bookStatus->value ? 'selected': ''}}>{{ $bookStatus }}</option>
                @endforeach
            </select>
        </form>
    </x-slot:action>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        @foreach($books as $book)
            <x-card :book="$book"></x-card>
        @endforeach
        {{ $books->links() }}
    </div>
</x-layout>
