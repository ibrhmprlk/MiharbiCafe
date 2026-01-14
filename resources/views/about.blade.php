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

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

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
                <span class="text-sm font-semibold text-indigo-600 uppercase">
                    About Us
                </span>

                @if($about)
                    <a href="{{ route('editAbout', $about->id) }}"
                       class="flex items-center gap-1 text-sm font-semibold text-indigo-500 hover:text-indigo-600 transition">
                        Edit
                        <i class="bi bi-chevron-right text-lg"></i>
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
                    <i class="bi bi-telephone text-gray-500 text-lg"></i>
                    <span>
                        {{ preg_replace('/(\d{3})(\d{3})(\d{2})(\d{2})/', '$1 $2 $3 $4', $about->phone) }}
                    </span>
                </div>

                <!-- EMAIL -->
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
</x-app-layout>
