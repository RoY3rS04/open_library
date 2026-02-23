<x-mail::message>
    # Welcome to OpenLibrary, {{ $user?->username }}!

    In order to continue using the app you have to verify your email, to do so just click the link below

    <x-mail::button :url="$url">Verify Email</x-mail::button>

</x-mail::message>
