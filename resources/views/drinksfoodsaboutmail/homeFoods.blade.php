<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Menu') }}</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</head>

<body class="min-h-screen bg-gray-50 text-gray-800 overflow-y-scroll">

<!-- NAVBAR -->
<!-- NAVBAR -->
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- LEFT -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800">
                    {{ config('app.name', 'Menu') }}
                </a>

                <!-- DESKTOP -->
                <div class="hidden sm:flex ml-10 space-x-6">
                    <a href="{{ route('drinksfoodsaboutmail.homeDrinks') }}"
                       class="text-gray-600 hover:text-black transition">
                        Drinks
                    </a>
                    <a href="{{ route('drinksfoodsaboutmail.homeAbout') }}"
                       class="text-gray-600 hover:text-black transition">
                        About
                    </a>
                    <a href="{{ route('contact.view') }}"
                       class="text-gray-600 hover:text-black transition">
                        Contact
                    </a>
                </div>
            </div>

            <!-- DESKTOP RIGHT -->
            <div class="hidden sm:flex items-center">
                <a href="{{ route('login') }}"
                   class="text-sm text-gray-600 hover:text-black">
                    Admin
                </a>
            </div>

            <!-- MOBILE BUTTON -->
            <div class="sm:hidden flex items-center">
                <button @click="open = !open"
                        class="p-2 rounded-md text-gray-500 hover:bg-gray-100">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open }"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{ 'hidden': !open }"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- MOBILE MENU -->
    <div x-show="open" x-transition class="sm:hidden border-t border-gray-100">
        <div class="px-4 pt-3 pb-4 space-y-2">
            <a href="{{ route('drinksfoodsaboutmail.homeDrinks') }}"
               class="block text-gray-600 hover:text-black">
                Drinks
            </a>
            <a href="{{ route('drinksfoodsaboutmail.homeAbout') }}"
               class="block text-gray-600 hover:text-black">
                About
            </a>
            <a href="{{ route('contact.view') }}"
               class="block text-gray-600 hover:text-black">
                Contact
            </a>

            <div class="pt-2 border-t border-gray-200">
                <a href="{{ route('login') }}"
                   class="block text-sm text-gray-600 hover:text-black">
                    Admin
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- CONTENT -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 py-10">

    <!-- FOODS -->
    <section>
        <h2 class="text-2xl font-semibold mb-6">🍔 Foods</h2>

        <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 gap-6 sm:gap-10">
            @forelse ($foods as $food)
                <div>
                    <div class="w-full sm:h-[330px] bg-gray-200 rounded-xl overflow-hidden">
    @if($food->image)
        <img
            src="{{ $food->image }}"
            alt="{{ $food->name }}"
            class="w-full h-auto sm:h-full object-contain sm:object-cover"
        >
    @else
        <div class="w-full h-[220px] sm:h-full flex items-center justify-center text-xs text-gray-400">
            No Image
        </div>
    @endif
</div>


                    <div class="flex items-center justify-between mt-3 sm:mt-4 text-sm">
                        <span class="truncate font-medium">{{ $food->name }}</span>
                        <span class="font-semibold">
                            {{ number_format($food->price, 2, ',', '.') }} ₺
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-gray-400 italic col-span-full">No foods found.</p>
            @endforelse
        </div>

    </section>

</main>

</body>
</html>
