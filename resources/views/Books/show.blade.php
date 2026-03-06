@php use App\Enums\BookStatus; @endphp
<x-layout title="{{$book->title}}" heading="{!! $book->title !!}">
    <section class="h-full flex flex-col gap-y-5 md:flex-row md:items-center md:gap-x-5 min-h-0">
        <div class="w-full md:flex-3 h-60 md:h-full">
            <div class="w-full h-full flex items-start justify-center">
                <img class="w-full h-full object-contain" src="{{ $book->getFirstMediaUrl('covers') }}" alt="Book Cover">
            </div>
        </div>
        <div class="md:flex-4 overflow-y-auto bg-white p-4 rounded-md border border-gray-200 w-full md:h-full">
            <div class="h-full flex flex-col gap-y-5">
                <header class="md:flex md:items-center md:justify-between">
                    <h2 class="text-xl border-b border-b-black font-medium">
                        @if($book->authors->count() > 1)
                            Authors
                        @else
                            Author
                        @endif
                    </h2>
                    <div class="hidden md:flex gap-x-4 items-center">
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
                <h3 class="font-medium border-b border-b-black">Synopsis</h3>
                <p class="text-sm">{{$book->synopsis}}</p>
                <h3 class="font-medium border-b border-b-black">Details</h3>
                <div class="space-y-4 text-sm">
                    <p>Pages: {{ $book->pages }} </p>
                    <p>Publication date: {{ $book->release_date->format('F j, Y') }}</p>
                    @php
                        $formatter = new NumberFormatter('en_US', NumberFormatter::ORDINAL);
                     @endphp
                    <p>Edition: {{ $formatter->format($book->edition) }} </p>
                    <p>Language: {{ $book->language }}</p>
                    <p>Publisher: {{ $book->publisher }}</p>
                    <p>{{ $book->isbn === 'null' ? '': $book->isbn }}</p>
                </div>
                <div class="space-y-3">
                    <a class="border-2 border-black p-2 inline-block" href="/books/{{ $book->id }}/download">Download</a>
                    @can('update', $book)
                        <div class="flex items-center gap-x-4">
                            <a href="/books/{{ $book->id }}/edit" class="py-2 px-4 border-2 border-black">Edit</a>
                            @if($book->status === BookStatus::Draft || $book->status === BookStatus::Rejected)
                                <form action="/books/{{ $book->id }}/request-approval" method="POST">
                                    @csrf
                                    <button class="cursor-pointer py-2 px-4 border-2 border-black">Send for Approval</button>
                                </form>
                            @endif
                        </div>
                    @endcan
                    @can('approve', $book)
                        @if($book->status === BookStatus::Pending)
                            <div class="flex items-center gap-x-4">
                                <form action="/books/{{ $book->id }}/reject" method="POST">
                                    @csrf
                                    <button class="cursor-pointer py-2 px-4 border-2 border-black">Reject</button>
                                </form>
                                <form action="/books/{{ $book->id }}/approve" method="POST">
                                    @csrf
                                    <button class="cursor-pointer py-2 px-4 border-2 border-black">Approve</button>
                                </form>
                            </div>
                        @endif
                    @endcan
                </div>
            </div>
        </div>
    </section>
</x-layout>
