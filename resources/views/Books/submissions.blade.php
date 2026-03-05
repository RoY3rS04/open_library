<x-layout title="Book Submissions" heading="Book Submissions">
    @if($books->count())
        <x-books_table :admin="true" :books="$books"></x-books_table>
    @else
        <h1>Nothing here yet!</h1>
    @endif
    {{ $books->links() }}
</x-layout>
