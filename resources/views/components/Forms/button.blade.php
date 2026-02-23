@props([
    'text' => 'Submit',
    'type' => 'submit'
])

<div class="flex gap-x-2 items-center">
    <button type="{{ $type }}" {{$attributes->merge(['class' => 'cursor-pointer border-gray-300 text-center flex-1'])}}>
        {{ $slot }}
        {{ $text }}
    </button>
</div>
