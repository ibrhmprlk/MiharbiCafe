<x-app-layout>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>

    <title>Edit Food</title>
</head>
<body class="bg-gray-100 min-h-screen">

<!-- ALERT -->
@if(session('success'))
    <div 
        x-data="{ show: true }" 
        x-show="show" 
        x-init="setTimeout(() => show = false, 4000)" 
        class="fixed top-5 right-5 z-50 bg-green-500 text-white px-5 py-3 rounded-lg shadow-lg"
    >
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div 
        x-data="{ show: true }" 
        x-show="show" 
        x-init="setTimeout(() => show = false, 4000)" 
        class="fixed top-5 right-5 z-50 bg-red-500 text-white px-5 py-3 rounded-lg shadow-lg"
    >
        {{ session('error') }}
    </div>
@endif

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-10 py-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h2 class="text-red-500 text-2xl font-semibold">
            Edit - {{ old('name', $ourPost->name) }}
        </h2>
         <a href="{{ route('foods') }}" class="text-sm font-medium text-green-600 hover:text-green-700 transition flex items-center">
            ← Back to Foods
        </a>
    </div>

    <!-- Form Card -->
    <div class="mt-5 bg-white rounded-2xl shadow-md p-6 sm:p-8">
        <form method="POST" action="{{ route('updateFood', $ourPost->id) }}" enctype="multipart/form-data">
            @csrf

            <div class="flex flex-col gap-6">
                <!-- Name -->
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-medium text-gray-700">Name</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $ourPost->name) }}"
                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                    />
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
                        value="{{ old('price', $ourPost->price) }}"
                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                    />
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
                        value="{{ old('image', $ourPost->image) }}"
                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                    />
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
                        value="Update"
                        class="w-full sm:w-auto bg-green-500 hover:bg-green-600 text-white py-2 px-6 rounded-lg font-medium transition cursor-pointer"
                    >
                </div>

            </div>
        </form>
    </div>

</div>

</body>
</html>
</x-app-layout>
