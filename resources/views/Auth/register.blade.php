<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>
<body class="h-screen flex items-center">
    <div class="w-2xl shadow-2xl mx-auto p-6">
        <header class="flex flex-col items-center">
            <x-icons.logo class="size-15"></x-icons.logo>
            <h1 class="font-bold text-2xl">Open Library</h1>
        </header>
        <form class="mt-10 space-y-5" method="POST" action="/register">
            @csrf
            <div class="flex flex-col gap-y-4">
                <x-Forms.input value="{{ old('username') }}" label="Username" id="username" name="username"></x-Forms.input>
                @error('username') <p class="text-sm font-medium text-red-600">{{ $message }}</p> @enderror
                <x-Forms.input value="{{ old('email') }}" label="Email" id="email" name="email" type="email"></x-Forms.input>
                @error('email') <p class="text-sm font-medium text-red-600">{{ $message }}</p> @enderror
                <x-Forms.input label="Password" id="password" name="password" type="password"></x-Forms.input>
                @error('password') <p class="text-sm font-medium text-red-600">{{ $message }}</p> @enderror
            </div>
            <p class="text-end text-sm">Already registered? <a class="text-blue-800" href="/login">Login</a></p>
            <x-Forms.button type="submit" class="bg-blue-500 py-2 px-1 text-white font-semibold rounded-sm" text="Register"></x-Forms.button>
        </form>
    </div>
</body>
</html>
