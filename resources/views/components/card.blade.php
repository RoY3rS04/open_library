 @php use Carbon\Carbon @endphp

<div class="flex flex-col h-75 overflow-hidden rounded-md border-2 border-black">
    <div class="w-full h-full flex-1 min-h-0 flex gap-x-4">
        <div class="w-full flex flex-col p-4 space-y-2">
            <div class="flex justify-between items-center">
                <h2 class="font-bold text-xl">
                    <a href="/books/{{ $book->id }}">{{ $book->title}}</a>
                </h2>
            </div>
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-md font-medium">
                        @if($book->authors()->count() > 1)
                            Authors
                        @else
                            Author
                        @endif
                    </p>
                    @foreach($book->authors as $author)
                        <span class="text-xs italic block">{{ $author->first_name . ' ' . $author->last_name }}</span>
                    @endforeach
                </div>
            </div>
            <div class="space-y-2">
                <p class="text-sm font-medium">Categories</p>
                <div class="space-y-1">
                    @foreach($book->categories as $category)
                        <span class="text-xs py-1 px-2 border border-black rounded-sm inline-block">{{ $category->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="w-full h-full overflow-hidden border-l-2 border-black">
            <img class="w-full h-full object-cover object-center" src="{{ $book->getFirstMediaUrl('covers') }}" alt="Book Cover">
        </div>
    </div>
    <div class=" flex items-center border-t-2 border-black">
        <div class="flex-1 border-r p-3 relative text-end">
            <span class="text-xs absolute top-2 left-2">Pages</span>
            <span class="text-sm">{{ $book->pages }}</span>
        </div>
        <div class="flex-1 border-r p-3 relative text-end">
            <span class="text-xs absolute top-2 left-2">
                <x-icons.calendar class="size-2"></x-icons.calendar>
            </span>
            <span class="text-sm">{{ Carbon::parse($book->release_date)->year }}</span>
        </div>
        <div class="flex-1 border-r p-3 relative text-end">
            <span class="text-xs absolute top-2 left-2">
                <x-icons.language></x-icons.language>
            </span>
            <span class="text-sm text-end">{{ $book->language }}</span>
        </div>
        <div class="flex-1">
            <a class="block p-3 relative text-end" href="/books/{{ $book->id }}/download">
                <span class="text-xs absolute top-2 left-2">
                    <x-icons.download></x-icons.download>
                </span>
                <span class="text-sm text-end">{{ $book->downloads ?? 1000 }}</span>
            </a>
        </div>
    </div>
</div>
