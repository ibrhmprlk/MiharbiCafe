<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Contact</title>

    <!-- Tailwind + Alpine -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
</head>

<body class="min-h-screen bg-gray-50 text-gray-800">

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
                    <a href="{{ route('drinksfoodsaboutmail.homeFoods') }}"
                       class="text-gray-600 hover:text-black transition">
                        Foods
                    </a>
                    <a href="{{ route('drinksfoodsaboutmail.homeAbout') }}"
                       class="text-gray-600 hover:text-black transition">
                        About
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
            <a href="{{ route('drinksfoodsaboutmail.homeFoods') }}"
               class="block text-gray-600 hover:text-black">
                Foods
            </a>
            <a href="{{ route('drinksfoodsaboutmail.homeAbout') }}"
               class="block text-gray-600 hover:text-black">
                About
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
<!-- CONTACT FORM -->
<main class="flex justify-center px-4 py-14">

@if(session('success'))
    <div 
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 4000)"
        x-transition
        class="fixed top-5 right-5 z-50 bg-green-600 text-white px-6 py-3 rounded-xl shadow-2xl">
        {{ session('success') }}
    </div>
@endif

    <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl p-8">

        <h1 class="text-2xl font-semibold mb-2">Contact Us</h1>
        <p class="text-gray-500 mb-6 text-sm">
            We’d love to hear from you. Fill out the form below.
        </p>

        <form method="POST" action="{{ route('contact.send') }}" class="space-y-5">
    @csrf

    <div>
        <label class="block text-sm font-medium mb-1">Name</label>
        <input type="text" name="name" required
               placeholder="Enter your full name"
               class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500">
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Email</label>
        <input type="email" name="email" required
               placeholder="Enter your email address"
               class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500">
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Message</label>
        <textarea name="message" rows="5" required
                  placeholder="Write your message here..."
                  class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500"></textarea>
    </div>

    <button type="submit"
            class="w-full py-3 rounded-xl font-semibold text-white
                   bg-gradient-to-r from-blue-600 to-blue-700 hover:opacity-90">
        Send Message
    </button>
</form>

    </div>
</main>

<style>
.nav-link {
    @apply text-gray-600 hover:text-black transition;
}
</style>

</body>
</html>
