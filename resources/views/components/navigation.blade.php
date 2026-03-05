@php use App\Models\Book; @endphp
<aside {{ $attributes->merge(['class' => 'h-full w-16 md:w-60 px-4 py-8 relative transition-all duration-300 ease-in nav-container']) }}>
    <nav class="flex flex-col items-center md:items-start h-full">
        <x-navigation_item class="font-bold text-xl" link="/" link_title="OpenLibrary">
            <x-icons.logo class="size-10"></x-icons.logo>
        </x-navigation_item>
        <div class="flex-1 flex flex-col gap-y-6 mt-10">
            <x-navigation_item link="/books/top" link_title="Top Books">
                <x-icons.chart class="size-6"></x-icons.chart>
            </x-navigation_item>
            <x-navigation_item link="/books/create" link_title="Upload a Book">
                <x-icons.upload class="size-6"></x-icons.upload>
            </x-navigation_item>
            <x-navigation_item link="/books" link_title="Submitted Books">
                <x-icons.archive class="size-6"></x-icons.archive>
            </x-navigation_item>
            @can('approve', Book::class)
                <x-navigation_item link="/books/submissions" link_title="Book Submissions">
                    <x-icons.submissions class="size-6"></x-icons.submissions>
                </x-navigation_item>
            @endcan
        </div>
        <div class="space-y-6">
            <x-navigation_item link="/user/settings" link_title="Settings">
                <x-icons.settings></x-icons.settings>
            </x-navigation_item>
            @auth
                <form action="/logout" method="POST" class="flex gap-x-3">
                    @csrf
                    @method('DELETE')
                    <x-Forms.button class="flex gap-x-2 border-none" type="submit" text="Logout">
                        <x-icons.logout></x-icons.logout>
                    </x-Forms.button>
                </form>
            @endauth
        </div>
    </nav>
    <button class="absolute bg-gray-100 p-2 text-gray-500 rounded-full opacity-0 z-[-1] md:opacity-100 md:z-1 top-1/2 -translate-y-1/2 -right-7 cursor-pointer nav-btn">
        <x-icons.chevron_left class="size-10"></x-icons.chevron_left>
    </button>
</aside>
