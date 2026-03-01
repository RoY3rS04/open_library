@props([
    'name' => '',
    'value' => '',
    'min' => 0,
    'max' => 0,
    'label' => '',
    'id' => ''
])

<div class="flex flex-col gap-y-2">
    <label for="{{ $id }}">{{ $label }}</label>
    <textarea id="{{ $id }}" {{ $attributes->merge(['class' => 'p-2 border-black border-2 w-full h-40']) }} name="{{ $name }}" minlength="{{ $min }}" maxlength="{{ $max }}">{{ $value }}</textarea>
</div>
