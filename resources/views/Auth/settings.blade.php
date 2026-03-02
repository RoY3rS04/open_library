@php use App\Models\Book; @endphp
<x-layout title="Settings" heading="Settings">
    <div>
        @can('approve', Book::class)
            <a href="https://t.me/YourBotName?start={{ auth()->id() }}"
               class="border-2 border-black p-2" target="_blank">
                Sync Telegram Notifications
            </a>
        @endcan
    </div>
</x-layout>
