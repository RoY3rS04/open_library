<x-layout title="{{$book->title}}" heading="{{ $book->title }}">
    <section class="h-full flex items-center gap-x-10 pt-10 min-h-0">
        <div class="flex-1 h-full min-h-0">
            <div class="flex flex-col h-full place-items-center gap-y-10 min-h-0">
                <div class="flex-2 w-full h-full min-h-0 overflow-hidden flex items-center justify-center">
                    <img class="w-full h-full object-contain" src="{{ $book->getFirstMediaUrl('covers') }}" alt="">
                </div>
                <div class="w-full h-full flex-1 space-y-4">
                    <p>{{ $book->pages }} pages</p>
                    <p>Publication date {{ $book->release_date }}</p>
                    <p>{{ $book->edition }}</p>
                    <p>{{ $book->language }}</p>
                    <p>{{ $book->publisher }}</p>
                    <p>{{ $book->isbn === 'null' ? '': $book->isbn }}</p>
                </div>
            </div>
        </div>
        <div class="flex-2 w-full h-full">
            <div class="space-y-5">
                <header class="flex items-center justify-between">
                    <h2 class="text-xl font-medium">
                        @if($book->authors()->count() > 1)
                            Authors
                        @else
                            Author
                        @endif
                    </h2>
                    <div class="flex gap-x-4 items-center">
                        @foreach($book->categories()->get() as $category)
                            <p class="italic text-sm">{{ $category->name }}</p>
                        @endforeach
                    </div>
                </header>
                <div class="">
                    <div>
                        <ul>
                            @foreach($book->authors()->get() as $author)
                                <li class="italic">{{ $author->first_name . ' ' . $author->last_name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <p class="text-sm">{{$book->synopsis}}</p>
            </div>
        </div>
    </section>
</x-layout>
