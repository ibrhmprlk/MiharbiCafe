<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About</title>

    <!-- Tailwind + Alpine -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
</head>
<body class="min-h-screen bg-gray-50 text-gray-800">

<!-- NAVBAR -->
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- LOGO + LINKS -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800"> {{ config('app.name', 'Menu') }} </a>
                <div class="hidden sm:flex ml-10 space-x-8">
                    <a href="{{ route('drinksfoodsaboutmail.homeDrinks') }}" class="text-gray-600 hover:text-black transition">Drinks</a>
                    <a href="{{ route('drinksfoodsaboutmail.homeFoods') }}" class="text-gray-600 hover:text-black transition">Foods</a>
                    <a href="{{ route('contact.view') }}" class="text-gray-600 hover:text-black transition">Contact</a>
                </div>
            </div>

            <!-- Admin/Login (desktop) -->
            <div class="hidden sm:flex items-center">
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-black">Admin</a>
            </div>

            <!-- Hamburger (mobile) -->
            <div class="sm:hidden flex items-center">
                <button @click="open = !open" class="p-2 rounded-md text-gray-400 hover:bg-gray-100">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open }" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{ 'hidden': !open }" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" x-transition class="sm:hidden border-t border-gray-100">
        <div class="px-4 pt-3 pb-4 space-y-2">
            <a href="{{ route('drinksfoodsaboutmail.homeDrinks') }}" class="block text-gray-600 hover:text-black transition">Drinks</a>
            <a href="{{ route('drinksfoodsaboutmail.homeFoods') }}" class="block text-gray-600 hover:text-black transition">Foods</a>
            <a href="{{ route('contact.view') }}" class="block text-gray-600 hover:text-black transition">Contact</a>
            <div class="pt-2 border-t border-gray-200">
                <a href="{{ route('login') }}" class="block text-sm text-gray-600 hover:text-black">Admin</a>
            </div>
        </div>
    </div>
</nav>

<!-- CONTENT -->
<main class="flex flex-col items-center px-4 sm:px-6 py-10 space-y-12">
    <div class="max-w-6xl w-full flex flex-col lg:flex-row gap-6 items-stretch">

        <!-- IMAGE -->
        <div class="flex-1 bg-gray-200 rounded-3xl overflow-hidden shadow-md hover:shadow-lg transition-all h-64 sm:h-80 lg:h-auto">
            @if($about && $about->image)
                <img src="{{ $about->image }}" class="w-full h-full object-cover object-center rounded-3xl">
            @else
                <div class="h-full flex items-center justify-center text-gray-400">No Image</div>
            @endif
        </div>

        <!-- TEXT -->
        <div class="flex-1 flex flex-col justify-start space-y-6 lg:pl-6 pt-4 lg:pt-0">
            <span class="text-sm font-semibold text-indigo-600 uppercase">About Us</span>
            <h2 class="text-3xl sm:text-4xl font-bold">{{ $about->title ?? 'About' }}</h2>
            <p class="text-gray-600 leading-relaxed">{{ $about->description }}</p>

            @if($about->second_paragraph)
                <p class="text-gray-600 leading-relaxed">{{ $about->second_paragraph }}</p>
            @endif
            @if($about->last_paragraph)
                <p class="text-gray-600 leading-relaxed">{{ $about->last_paragraph }}</p>
            @endif

            <!-- CONTACT -->
            <div class="pt-4 border-t border-gray-200 text-sm flex flex-col sm:flex-row sm:items-center sm:gap-6">
                <div class="flex items-center gap-2">
                    <i class="bi bi-telephone text-gray-500 text-lg"></i>
                    <span>{{ preg_replace('/(\d{3})(\d{3})(\d{2})(\d{2})/', '$1 $2 $3 $4', $about->phone) }}</span>
                </div>

                <div class="flex items-center gap-2 mt-2 sm:mt-0">
                    <i class="bi bi-envelope text-gray-500 text-lg"></i>
                    <span>{{ $about->email }}</span>
                </div>
            </div>

            <!-- SOCIALS -->
            <div class="flex gap-4 pt-4 text-2xl text-gray-600">
                @if(!empty($about->instagram_url))
                    <a href="{{ $about->instagram_url }}" target="_blank" class="hover:text-black transition">
                        <i class="bi bi-instagram"></i>
                    </a>
                @endif
                @if(!empty($about->twitter_url))
                    <a href="{{ $about->twitter_url }}" target="_blank" class="hover:text-black transition">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                @endif
                @if(!empty($about->github_url))
                    <a href="{{ $about->github_url }}" target="_blank" class="hover:text-black transition">
                        <i class="bi bi-github"></i>
                    </a>
                @endif
                @if(!empty($about->linkedin_url))
                    <a href="{{ $about->linkedin_url }}" target="_blank" class="hover:text-black transition">
                        <i class="bi bi-linkedin"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
</main>

</body>
</html>
