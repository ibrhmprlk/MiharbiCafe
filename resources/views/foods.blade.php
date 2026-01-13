<x-app-layout>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Foods') }}</title>

    <!-- Tailwind + Alpine -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Font + Feather -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body class="min-h-screen bg-gray-50 text-gray-800" x-data="paginationHandler()">

<!-- ALERTS -->
@if(session('success'))
<div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,4000)"
     class="fixed top-5 right-5 z-50 bg-green-500 text-white px-5 py-3 rounded-lg shadow-lg flex items-center gap-2">
    <i data-feather="check-circle" class="w-5 h-5"></i>
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,4000)"
     class="fixed top-5 right-5 z-50 bg-red-500 text-white px-5 py-3 rounded-lg shadow-lg flex items-center gap-2">
    <i data-feather="x-circle" class="w-5 h-5"></i>
    {{ session('error') }}
</div>
@endif

<main class="max-w-7xl mx-auto px-4 sm:px-6 py-10">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-semibold">🍔 Foods</h2>

        <a href="{{ route('foods.create') }}"
           class="flex items-center gap-2 text-sm font-semibold text-blue-600 hover:underline">
            <i data-feather="plus"></i>
            Add New Food
        </a>
    </div>

    <!-- GRID -->
    <section id="foods-section">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">

            @forelse ($foods as $food)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden flex flex-col">

                <!-- IMAGE -->
                <div class="w-full h-44 sm:h-52 md:h-60 bg-gray-200">
                    @if($food->image)
                        <img src="{{ $food->image }}" alt="{{ $food->name }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-xs text-gray-400">
                            No Image
                        </div>
                    @endif
                </div>

                <!-- CONTENT -->
                <div class="p-3 flex flex-col gap-3 flex-1">

                    <!-- NAME + PRICE -->
                    <div class="flex justify-between gap-2 text-sm">
                        <span class="font-medium leading-snug line-clamp-2 break-words">
                            {{ $food->name }}
                        </span>

                        <span class="shrink-0 font-semibold bg-gray-100 px-2 py-0.5 rounded-md">
                            {{ number_format($food->price, 2, ',', '.') }} ₺
                        </span>
                    </div>

                    <!-- ACTIONS -->
                    <div class="flex justify-end gap-3 mt-auto">

                        <!-- Edit -->
                        <a href="{{ route('editFood', $food->id) }}"
                           class="w-8 h-8 flex items-center justify-center rounded-md text-blue-600 hover:bg-blue-50">
                            <i data-feather="edit" class="w-4 h-4"></i>
                        </a>

                        <!-- Delete -->
                        <form action="{{ route('deleteFood', $food->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button
                                class="w-8 h-8 flex items-center justify-center rounded-md text-red-600 hover:bg-red-50">
                                <i data-feather="trash" class="w-4 h-4"></i>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
            @empty
                <p class="col-span-full text-center text-gray-400 italic">
                    No foods found.
                </p>
            @endforelse

        </div>

        <!-- PAGINATION KALDIRILDI -->
    </section>

</main>

<script>
    feather.replace()

    function paginationHandler() {
        return {
            loadPage(event, sectionId) {
                // Pagination kaldırıldığı için artık kullanılmıyor
            }
        }
    }
</script>

</body>
</html>
</x-app-layout>
