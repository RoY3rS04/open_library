@props([
    'title' => '',
    'icon' => '',
    'color' => '',
    'bg_color' => ''
])

<div class="flex items-center justify-center gap-x-1 rounded-md p-1 {{$color}} {{$bg_color}}">
    {!! $icon !!}
    <span>{{ $title }}</span>
</div>
