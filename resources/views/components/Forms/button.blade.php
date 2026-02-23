@props([
    'text' => 'Submit',
    'type' => 'submit'
])

<div class="flex gap-x-2 items-center">
    {{ $slot }}
    <button type="{{ $type }}" {{$attributes->merge(['class' => 'py-2 px-4 cursor-pointer border-gray-300 text-center flex-1'])}}>{{ $text }}</button>
</div>
