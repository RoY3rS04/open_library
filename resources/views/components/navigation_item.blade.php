@props([
    'link' => '#',
    'link_title' => ''
])

<div class="flex gap-x-2 items-center">
    <a {{$attributes->merge(['class' => 'flex items-center gap-x-2'])}} href="{{ $link }}">
        {{ $slot }}
        <span class="nav-title hidden md:block">{{$link_title}}</span>
    </a>
</div>
