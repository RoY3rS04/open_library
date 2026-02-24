@props([
    'type' => 'text',
    'label' => '',
    'name' => '',
    'id' => '',
    'required' => true,
    'value' => ''
])

<div class="flex flex-col gap-y-2">
    <label>{{ $label }}</label>
    <input value="{{ $value }}" required="{{$required}}" {{ $attributes->merge(['class' => 'py-1 px-2 border border-gray-300 rounded-sm']) }} id="{{ $id }}" name="{{ $name }}" type="{{ $type }}">
</div>
