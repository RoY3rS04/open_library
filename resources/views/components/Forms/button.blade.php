@props([
    'text' => 'Submit',
    'type' => 'submit',
    'disabled' => false,
    'form' => ''
])

<div class="flex gap-x-2 items-center">
    <button {{ $form ? 'form='.$form : '' }} {{ $disabled ? 'disabled' : '' }} type="{{ $type }}" {{$attributes->merge(['class' => 'cursor-pointer border-2 border-black text-center flex-1'])}}>
        {{ $slot }}
        {{ $text }}
    </button>
</div>
