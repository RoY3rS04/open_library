<x-layout title="Upload a Book" heading="Upload a Book">
    @if($errors->count())
        {{dd($errors->all())}}
    @endif
    <x-slot:files>
        @vite(['resources/js/drag_drop.js'])
    </x-slot:files>
    <x-slot:action>
        <x-Forms.button disabled={{true}} form="upload-book" class="inline py-2 px-4 border-2 border-gray-900 submitBtn"></x-Forms.button>
    </x-slot:action>
    <div id="target" class="h-full my-5 border-gray-500 border-2 border-dashed flex items-center justify-center relative">
        <label for="file" class="absolute top-0 left-0 right-0 bottom-0 cursor-pointer"></label>
        <h2 class="text-3xl text-center mx-1 target__heading">Drag and drop your PDF file here</h2>
        <form enctype="multipart/form-data" id="upload-book" action="/books" method="POST">
            @csrf
            <x-Forms.input accept=".pdf" class="hidden" type="file" id="file" name="file"></x-Forms.input>
        </form>
    </div>
</x-layout>
