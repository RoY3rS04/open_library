@props([
    'admin' => false,
    'books' => []
])

<div class="w-full border-2 rounded-lg border-gray-200">
    <table class="table-auto min-w-full divide-y border-gray-50 rounded-md divide-gray-200 bg-white">
        <thead>
        <tr>
            <th class="py-2 px-4 text-left text-sm">Title</th>
            <th class="py-2 px-4 text-left text-sm">Downloads</th>
            <th class="py-2 px-4 text-left text-sm">Submitted By</th>
            @if($admin) <th class="py-2 px-4 text-left text-sm">Status</th> @endif
            <th class="py-2 px-4 text-left text-sm">Categories</th>
            <th></th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
        @foreach($books as $book)
            <tr class="text-gray-700">
                <td class="py-2 px-4 text-sm">{{ ucwords($book->title) }}</td>
                <td class="py-2 px-4 text-sm">{{ $book->downloads }}</td>
                <td class="py-2 px-4 text-sm">{{ $book->submittedBy->username }}</td>
                @if($admin)
                    <td class="py-2 px-4 text-xs">
                        <x-badge
                            :icon="$book->status->getIcon()"
                            :title="$book->status->value"
                            :color="$book->status->getColor()"
                            :bg_color="$book->status->getBgColor()"
                        ></x-badge>
                    </td>
                @endif
                <td class="py-2 px-4 text-[10px] max-w-70">
                    <div class="gap-y-2 space-y-2">
                        @foreach($book->categories as $category)
                            <span class="p-1 border inline-block rounded-md">{{ $category->name }}</span>
                        @endforeach
                    </div>
                </td>
                <td class="py-2 px-4 text-xs">
                    <div class="flex items-center gap-x-2">
                        <a class="flex items-center gap-x-1" href="/books/{{ $book->id }}">
                            <x-icons.eye class=""></x-icons.eye>
                            View
                        </a>
                        @can('update', $book)
                            <a class="flex items-center gap-x-1" href="/books/{{ $book->id }}/edit">
                                <x-icons.edit></x-icons.edit>
                                Edit
                            </a>
                        @endcan
                    </div>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
