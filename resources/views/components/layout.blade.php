@props([
    'title' => '',
    'heading' => '',
    'files' => '',
    'action' => null
])

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/dom.js'])
    @if($files) {{ $files }} @endif
</head>
<body class="h-screen">
    <div class="h-full grid grid-cols-5">
        <x-navigation class="border-r border-gray-300"></x-navigation>
        <main class="col-start-2 -col-end-1 p-10 flex flex-col">
            <header class="flex items-center justify-between">
                <h1 class="text-2xl">{{ $heading }}</h1>
                {{ $action }}
            </header>
            <article class="flex-1">{{ $slot }}</article>
        </main>
    </div>
</body>
</html>
