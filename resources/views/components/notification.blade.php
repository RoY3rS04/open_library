@php use App\Enums\NotificationType; @endphp
@props([
    'type' => 1,
    'title' => '',
    'uuid' => ''
])

@php
    $styles = match ($type) {
        NotificationType::Success => 'bg-green-200 border-green-800 text-green-800',
        NotificationType::Error => 'bg-red-200 border-red-800 text-red-800',
        NotificationType::Information => 'bg-blue-200 border-blue-800 text-blue-800',
    }
@endphp

<div data-uuid="{{ $uuid }}" class="w-full p-3 flex flex-col gap-y-3 border-2 {{ $styles }}">
    <div class="flex items-center justify-between gap-x-5">
        <div class="flex items-center gap-x-1">
            @switch($type)

                @case(NotificationType::Success)
                    <x-icons.success/>
                    @break
                @case(NotificationType::Error)
                    <x-icons.error/>
                    @break
                @case(NotificationType::Information)
                    <x-icons.info/>
                    @break
                @default

            @endswitch
            <p class="font-medium text-md">{{ $title }}</p>
        </div>
        <button data-uuid="{{ $uuid }}" class="cursor-pointer close-notification">
            <x-icons.close/>
        </button>
    </div>
    {{ $slot }}
</div>
