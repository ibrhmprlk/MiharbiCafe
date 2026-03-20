<x-app-layout>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Dashboard') }}</title>

    <!-- Tailwind + Alpine -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body class="min-h-screen bg-gray-50 text-gray-800 flex items-center justify-center">
<main class="w-full min-h-screen flex items-center justify-center px-6 pt-12 pb-20">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 justify-items-center">

        <!-- USERS -->
        <a href="{{ route('kullanicilar') }}" 
           class="flex flex-col items-center justify-center p-10 bg-white rounded-3xl shadow-lg hover:shadow-2xl transition text-gray-800 w-56">
            <i data-feather="users" class="w-16 h-16 mb-4"></i>
            <span class="text-xl font-semibold text-center">Users</span>
        </a>

        <!-- DRINKS -->
        <a href="{{ route('drinks') }}" 
           class="flex flex-col items-center justify-center p-10 bg-white rounded-3xl shadow-lg hover:shadow-2xl transition text-gray-800 w-56">
            <i data-feather="coffee" class="w-16 h-16 mb-4"></i>
            <span class="text-xl font-semibold text-center">Drinks</span>
        </a>

        <!-- FOODS -->
        <a href="{{ route('foods') }}" 
           class="flex flex-col items-center justify-center p-10 bg-white rounded-3xl shadow-lg hover:shadow-2xl transition text-gray-800 w-56">
            <i data-feather="shopping-bag" class="w-16 h-16 mb-4"></i>
            <span class="text-xl font-semibold text-center">Foods</span>
        </a>

        <!-- ABOUT -->
        <a href="{{ route('about') }}" 
           class="flex flex-col items-center justify-center p-10 bg-white rounded-3xl shadow-lg hover:shadow-2xl transition text-gray-800 w-56">
            <i data-feather="info" class="w-16 h-16 mb-4"></i>
            <span class="text-xl font-semibold text-center">About</span>
        </a>

    </div>
</main>

<script>
    feather.replace()
</script>

</body>
</html>
</x-app-layout>
