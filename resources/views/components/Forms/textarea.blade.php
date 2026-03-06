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
    <textarea id="{{ $id }}" {{ $attributes->merge(['class' => 'p-2 border-gray-200 border w-full h-30']) }} name="{{ $name }}" minlength="{{ $min }}" maxlength="{{ $max }}">{{ $value }}</textarea>
</div>
