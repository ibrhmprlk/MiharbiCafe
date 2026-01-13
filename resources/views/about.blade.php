<x-app-layout>
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About</title>

    <!-- Tailwind + Alpine -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
</head>
<body class="min-h-screen bg-gray-50 text-gray-800">

<!-- SUCCESS / ERROR ALERT -->
@if(session('success'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
     class="fixed top-5 right-5 z-50 bg-green-500 text-white px-5 py-3 rounded-lg shadow-lg">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
     class="fixed top-5 right-5 z-50 bg-red-500 text-white px-5 py-3 rounded-lg shadow-lg">
    {{ session('error') }}
</div>
@endif

<!-- CONTENT -->
<main class="flex flex-col items-center justify-center min-h-[calc(150vh-80px)] px-6 pt-16 pb-32">
    <div class="max-w-6xl w-full flex flex-col lg:flex-row gap-6 items-stretch justify-start">
        <!-- IMAGE -->
        <div class="flex-1 bg-gray-200 rounded-3xl overflow-hidden">
            @if($about && $about->image)
                <img src="{{ $about->image }}" class="w-full h-full object-cover object-top rounded-3xl">
            @else
                <div class="h-full flex items-center justify-center text-gray-400">
                    No Image
                </div>
            @endif
        </div>

        <!-- TEXT -->
        <div class="flex-1 flex flex-col justify-start space-y-6 lg:pl-6 pt-3">

            <div class="flex items-center justify-between leading-none">
                <span class="text-sm font-semibold text-indigo-600 uppercase leading-none">
                    About Us
                </span>

                @if($about)
                    <a href="{{ route('editAbout', $about->id) }}"
                       class="flex items-center gap-1
                              text-sm font-semibold leading-none
                              text-indigo-500 hover:text-indigo-600 transition">
                        Edit
                        <svg class="w-5 h-5 translate-y-[1px]"
                             fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @endif
            </div>

            <h2 class="text-4xl font-bold">{{ $about->title ?? 'About' }}</h2>

            <p class="text-gray-600 leading-relaxed">{{ $about->description }}</p>

            @if($about->second_paragraph)
                <p class="text-gray-600 leading-relaxed">{{ $about->second_paragraph }}</p>
            @endif

            @if($about->last_paragraph)
                <p class="text-gray-600 leading-relaxed">{{ $about->last_paragraph }}</p>
            @endif

            <!-- CONTACT -->
            <div class="pt-4 border-t border-gray-200 text-sm flex flex-col sm:flex-row sm:items-center sm:gap-6">
                <!-- PHONE -->
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 5a2 2 0 012-2h3l2 5-3 2a11 11 0 005 5l2-3 5 2v3a2 2 0 01-2 2A16 16 0 013 5z"/>
                    </svg>
                    <span>{{ preg_replace('/(\d{3})(\d{3})(\d{2})(\d{2})/', '$1 $2 $3 $4', $about->phone) }}</span>
                </div>

                <!-- EMAIL -->
                <div class="flex items-center gap-2 mt-2 sm:mt-0">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ $about->email }}</span>
                </div>
            </div>

            <!-- SOCIALS -->
            <div class="flex gap-4 pt-4">
                <a href="{{ $about->instagram_url }}" target="_blank" class="hover:text-black">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7 2C4.8 2 3 3.8 3 6v12c0 2.2 1.8 4 4 4h10c2.2 0 4-1.8 4-4V6c0-2.2-1.8-4-4-4H7zm10 2a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2h10z"/>
                        <path d="M12 7a5 5 0 100 10 5 5 0 000-10zm0 8a3 3 0 110-6 3 3 0 010 6z"/>
                        <circle cx="17.5" cy="6.5" r="1.5"/>
                    </svg>
                </a>

                <a href="{{ $about->twitter_url }}" target="_blank" class="hover:text-black">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22 5.8c-.8.4-1.6.6-2.5.8a4.3 4.3 0 001.9-2.4 8.6 8.6 0 01-2.7 1 4.3 4.3 0 00-7.3 3.9A12.2 12.2 0 013 4.9a4.3 4.3 0 001.3 5.8 4.2 4.2 0 01-2-.6v.1a4.3 4.3 0 003.4 4.2 4.4 4.4 0 01-2 .1 4.3 4.3 0 004 3 8.6 8.6 0 01-5.3 1.8c-.3 0-.6 0-.9-.1a12.2 12.2 0 006.6 1.9c7.9 0 12.2-6.6 12.2-12.2v-.6A8.7 8.7 0 0022 5.8z"/>
                    </svg>
                </a>

                <a href="{{ $about->github_url }}" target="_blank" class="hover:text-black">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2a10 10 0 00-3.2 19.5c.5.1.7-.2.7-.5v-1.8c-2.9.6-3.5-1.4-3.5-1.4-.5-1.2-1.2-1.5-1.2-1.5-1-.7.1-.7.1-.7 1.1.1 1.7 1.2 1.7 1.2 1 .1.7 1.8 1.7 2.2.2-.7.4-1.2.7-1.5-2.3-.3-4.7-1.2-4.7-5.3 0-1.2.4-2.2 1.1-3-.1-.3-.5-1.4.1-3 0 0 .9-.3 3 1.1a10.4 10.4 0 015.4 0c2.1-1.4 3-1.1 3-1.1.6 1.6.2 2.7.1 3 .7.8 1.1 1.8 1.1 3 0 4.1-2.4 5-4.7 5.3.4.3.8 1 .8 2v3c0 .3.2.6.7.5A10 10 0 0012 2z"/>
                    </svg>
                </a>
            </div>

        </div>
    </div>
</main>

</body>
</html>
</x-app-layout>
