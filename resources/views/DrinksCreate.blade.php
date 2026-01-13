<x-app-layout>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Drinks') }}</title>

    <!-- Tailwind + Alpine -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
</head>
<body class="min-h-screen bg-gray-50 text-gray-800">
<main class="max-w-7xl mx-auto px-6 py-10 space-y-12">

    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Drinks</h2>
        <a href="{{ route('drinks') }}" class="text-sm font-medium text-green-600 hover:text-green-700 transition flex items-center">
            ← Back to Drinks
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-md p-6 sm:p-8">
        <form method="POST" action="{{route('drinks')}}" enctype="multipart/form-data">
            @csrf

            <div class="flex flex-col gap-6">

                <!-- Name -->
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-medium text-gray-700">Name</label>
                    <input
                        type="text"
                        name="name"
                        value="{{old('name')}}"
                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                    >
                    @error('name')
                    <p class="text-sm text-red-600 bg-red-50 border border-red-200 px-3 py-2 rounded-lg">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Price -->
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-medium text-gray-700">Price</label>
                    <input
                        type="text"
                        name="price"
                        value="{{old('price')}}"
                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                    >
                    @error('price')
                    <p class="text-sm text-red-600 bg-red-50 border border-red-200 px-3 py-2 rounded-lg">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Image -->
                <div class="flex flex-col gap-2">
                   <label class="text-sm font-medium text-gray-700">Image URL</label>
                   <input
                        type="url"
                        name="image"
                        value="{{ old('image') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                   >
                    @error('image')
                    <p class="text-sm text-red-600 bg-red-50 border border-red-200 px-3 py-2 rounded-lg">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Submit -->
                <div class="pt-2">
                    <input
                        type="submit"
                        value="Create"
                        class="w-full sm:w-auto bg-green-500 hover:bg-green-600 text-white py-2 px-6 rounded-lg font-medium transition cursor-pointer"
                    >
                </div>

            </div>
        </form>
    </div>

</main>

</body>
</html>
</x-app-layout>
