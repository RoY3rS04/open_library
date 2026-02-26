@php use Illuminate\Support\Facades\Auth; @endphp

<x-layout title="welcome" heading="Welcome Back {{ Auth::user()->username }}">
    @if(session('success'))
        <div class="bg-green-400 text-green-800 p-4 rounded-sm">
            {{ session('success') }}
        </div>
    @endif
</x-layout>
