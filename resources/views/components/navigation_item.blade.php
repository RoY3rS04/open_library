@props([
    'link' => '#',
    'link_title' => ''
])

<div class="flex gap-x-2 items-center">
    {{ $slot }}
    <a {{$attributes->merge(['class' => ''])}} href="{{ $link }}">{{$link_title}}</a>
</div>
