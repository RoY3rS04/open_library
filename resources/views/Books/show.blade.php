@php use App\Enums\BookStatus; @endphp
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
                <div class="space-y-5">
                    <a class="border-2 border-black p-2 inline-block" href="/books/{{ $book->id }}/download">Download</a>
                    @can('update', $book)
                        <div class="flex items-center gap-x-4">
                            <a href="/books/{{ $book->id }}/edit" class="py-2 px-4 border-2 border-black">Edit</a>
                            @if($book->status === BookStatus::Draft->value || $book->status === BookStatus::Rejected->value)
                                <form action="/books/{{ $book->id }}/request-approval" method="POST">
                                    @csrf
                                    <button class="cursor-pointer py-2 px-4 border-2 border-black">Send for Approval</button>
                                </form>
                            @endif
                        </div>
                    @endcan
                    @can('approve', $book)
                        @if($book->status === BookStatus::Pending->value)
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
