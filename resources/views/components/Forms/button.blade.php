@props([
    'text' => 'Submit',
    'type' => 'submit',
    'disabled' => false,
    'form' => ''
])

<div class="flex gap-x-2 items-center">
    <button {{ $form ? 'form='.$form : '' }} {{ $disabled ? 'disabled' : '' }} type="{{ $type }}" {{$attributes->merge(['class' => 'cursor-pointer border-2 border-black text-center flex-1'])}}>
        {{ $slot }}
        <span class="{{ $text === 'Logout' ? 'nav-title hidden md:block' : '' }}">{{ $text }}</span>
    </button>
</div>
