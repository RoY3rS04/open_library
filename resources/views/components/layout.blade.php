@php use App\Enums\NotificationType; @endphp
@props([
    'title' => '',
    'heading' => '',
    'files' => '',
    'action' => null,
])

    @php
        $notification = session('notification');
    @endphp

    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if($files)
        {{ $files }}
    @endif
</head>
<body class="h-screen">
<span class="hidden" id="user_info" data-user-role="{{ Auth::user()->role }}" data-user-id="{{ auth()->id() }}"></span>
<div class="h-full grid grid-cols-5 min-h-0">
    <x-navigation class="border-r border-gray-300"></x-navigation>
    <main class="col-start-2 -col-end-1 p-10 flex flex-col space-y-5 min-h-0">
        <header class="flex items-center justify-between">
            <h1 class="text-2xl">{{ $heading }}</h1>
            {{ $action }}
        </header>
        <article class="flex-1 min-h-0 overflow-auto">{{ $slot }}</article>
    </main>
</div>
<div id="notifications" class="absolute space-y-2 bottom-0 right-0 min-w-80 p-3 z-10">
    @if($notification)
        <x-notification uuid="{{ $notification['id'] }}" title="{{ $notification['title'] }}" :type="$notification['type']">
            <div class="space-y-2">
                @if(key_exists('msg', $notification))
                    <p class="text-sx text-current">{{ $notification['msg'] }}</p>
                @endif
                @if(key_exists('action', $notification))
                    <a class="border-2 border-current p-2" href="{{ $notification['action'] }}">sup</a>
                @endif
            </div>
        </x-notification>
    @endif
</div>
</body>
</html>
