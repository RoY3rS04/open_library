<x-layout title="{{$book->title}}" heading="{!! $book->title !!}">
    <section class="h-full flex items-center gap-x-5 min-h-0">
        <div class="flex-3 h-full min-h-0">
            <div class="w-full h-full flex items-start justify-center">
                <img class="w-full object-contain" src="{{ $book->getFirstMediaUrl('covers') }}" alt="">
            </div>
        </div>
        <div class="flex-4 w-full h-full">
            <div class="h-full flex flex-col gap-y-5">
                <header class="flex items-center justify-between">
                    <h2 class="text-xl font-medium">
                        @if($book->authors->count() > 1)
                            Authors
                        @else
                            Author
                        @endif
                    </h2>
                    <div class="flex gap-x-4 items-center">
                        @foreach($book->categories as $category)
                            <p class="italic text-sm">{{ $category->name }}</p>
                        @endforeach
                    </div>
                </header>
                <div>
                    <ul>
                        @foreach($book->authors as $author)
                            <li class="italic">{{ $author->first_name . ' ' . $author->last_name }}</li>
                        @endforeach
                    </ul>
                </div>
                <p class="text-sm">{{$book->synopsis}}</p>
                <div class="space-y-4">
                    <p>{{ $book->pages }} pages</p>
                    <p>Publication date: {{ $book->release_date }}</p>
                    <p>{{ $book->edition }}</p>
                    <p>Language: {{ $book->language }}</p>
                    <p>Publisher: {{ $book->publisher }}</p>
                    <p>{{ $book->isbn === 'null' ? '': $book->isbn }}</p>
                </div>
                <div class="flex items-center mt-10 justify-between">
                    <a href="/books/{{ $book->id }}/edit" class="py-2 px-4 border-2 border-black">Edit</a>
                    <form action="/books/send" method="POST">
                        @csrf
                        <button class="cursor-pointer py-2 px-4 border-2 border-black">Send for Approval</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout>
