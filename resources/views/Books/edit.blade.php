@php
    $authorsString = $book->authors->map(fn ($author) => $author->first_name . ' ' . $author->last_name)
                        ->implode(', ');

    $categoriesString = $book->categories->map(fn ($category) => $category->name)
                        ->implode(', ');
@endphp

<x-layout title="Update Your Book">
    <div class="flex gap-x-5">
        <div class="flex-2">
            <img src="{{ $book->getFirstMediaUrl('covers') }}" alt="Cover image">
        </div>
        <div class="flex-3 min-w-0">
            <form method="POST" class="space-y-3 text-sm" action="/books/{{ $book->id }}">
                @csrf
                @method('PATCH')
                <x-Forms.input name="title" label="Title" value="{!! $book->title !!}"/>
                <x-Forms.input name="authors" label="Authors, use (firstName lastName, ...) format" value="{{ $authorsString }}"/>
                <x-Forms.textarea name="synopsis" label="Synopsis" value="{!! $book->synopsis !!}"/>
                <x-Forms.input name="categories" label="Categories use (category, ...) format" value="{{ $categoriesString }}"></x-Forms.input>
                <div class="flex gap-x-2 items-center max-w-full">
                    <x-Forms.input name="release_date" type="date" label="Release Date" class="w-full" value="{{ $book->release_date }}"></x-Forms.input>
                    <x-Forms.input name="pages" label="Pages" type="number" min="1" class="w-full" value="{{ $book->pages }}"></x-Forms.input>
                    <x-Forms.input name="language" label="Language" class="w-full" value="{{ $book->language }}"></x-Forms.input>
                    <x-Forms.input name="edition" label="Edition" class="w-full" value="{{ $book->edition }}"></x-Forms.input>
                </div>
                <button class="p-2 border-black border-2 w-full cursor-pointer">Update Book Metadata</button>
            </form>
        </div>
    </div>
</x-layout>
