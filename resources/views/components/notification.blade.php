@php use App\Enums\NotificationType; @endphp
@props([
    'type' => 1,
    'title' => '',
])

@php
    $styles = match ($type) {
        NotificationType::Success => 'bg-green-200 border-green-600 text-green-800',
        NotificationType::Error => 'border-red-500',
        NotificationType::Information => 'border-blue-500',
    }
@endphp

<div class="absolute flex flex-col gap-y-3 bottom-4 right-4 p-3 z-10 w-80 border-2 {{ $styles }}">
    <div class="flex items-center justify-between">
        <p class="font-medium">{{ $title }}</p>
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
    </div>
    {{ $slot }}
</div>
