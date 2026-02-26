<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body class="h-screen flex items-center">
<div class="w-2xl shadow mx-auto p-6">
    <header class="flex flex-col items-center">
        <x-icons.logo class="size-15"></x-icons.logo>
        <h1 class="font-bold text-2xl">Open Library</h1>
    </header>
    <form class="mt-10 space-y-8" method="POST" action="">
        @csrf
        <div class="flex flex-col gap-y-4">
            <x-Forms.input value="{{ old('email') }}" label="Email" id="email" name="email"></x-Forms.input>
            @error('email') <p class="text-sm font-semibold text-red-600">{{ $message }}</p>  @enderror
            <x-Forms.input label="Password" id="password" name="password" type="password"></x-Forms.input>
            @error('password') <p class="text-sm font-semibold text-red-600">{{ $message }}</p>  @enderror
            @error('msg') <p class="text-sm font-semibold text-red-600">{{ $message }}</p>  @enderror
            <p class="text-end text-sm">You don't have an account yet? <a class="text-blue-800" href="/register">Register</a></p>
        </div>
        <x-Forms.button type="submit" class="bg-blue-500 py-2 px-1 text-white font-semibold rounded-sm" text="Login"></x-Forms.button>
    </form>
</div>
</body>
</html>
