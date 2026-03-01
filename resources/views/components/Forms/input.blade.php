@props([
    'type' => 'text',
    'label' => '',
    'name' => '',
    'id' => '',
    'required' => true,
    'value' => '',
    'accept' => null,
])

<div class="flex flex-col gap-y-2">
    <label for="{{ $id }}">{{ $label }}</label>
    <input accept="{{ $accept }}" value="{{ $value }}" required="{{$required}}" {{ $attributes->merge(['class' => 'py-1 px-2 border-2 border-black rounded-sm']) }} id="{{ $id }}" name="{{ $name }}" type="{{ $type }}">
</div>
