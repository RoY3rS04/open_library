<aside {{ $attributes->merge(['class' => 'h-full px-4 py-8 relative nav-container']) }}>
    <nav class="flex flex-col h-full">
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
            <x-navigation_item link="/books/top" link_title="Submitted Books">
                <x-icons.archive class="size-6"></x-icons.archive>
            </x-navigation_item>
        </div>
        <div class="space-y-6">
            <x-navigation_item link="/user/settings" link_title="Settings">
                <x-icons.settings></x-icons.settings>
            </x-navigation_item>
            @auth
                <form action="/logout" method="POST" class="flex gap-x-3">
                    @csrf
                    @method('DELETE')
                    <x-Forms.button class="flex gap-x-2" type="submit" text="Logout">
                        <x-icons.logout></x-icons.logout>
                    </x-Forms.button>
                </form>
            @endauth
        </div>
    </nav>
    <!-- <button class="absolute bg-gray-200 p-2 rounded-full top-1/2 -translate-y-1/2 -right-7 cursor-pointer nav-btn">
        <x-icons.chevron_left class="size-10"></x-icons.chevron_left>
    </button> !-->
</aside>
