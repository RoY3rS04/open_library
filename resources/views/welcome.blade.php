<x-layout title="welcome" heading="Welcome">
    @if(session('success'))
        <div class="bg-green-400 text-green-800 p-4 rounded-sm">
            {{ session('success') }}
        </div>
    @endif
</x-layout>
