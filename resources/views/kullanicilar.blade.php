<x-app-layout>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Users</title>

    <!-- Tailwind + Alpine -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
</head>

<body class="min-h-screen bg-gray-50 text-gray-800">

<form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
    @csrf
</form>

<!-- ALERTS -->
@if(session('success'))
<div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,4000)"
     class="fixed top-5 right-5 z-50 bg-emerald-500 text-white px-5 py-3 rounded-xl shadow-lg">
    {{ session('success') }}
</div>
@endif

@if(session('error') || $errors->any())
<div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,4000)"
     class="fixed top-5 right-5 z-50 bg-red-500 text-white px-5 py-3 rounded-xl shadow-lg">
    {{ session('error') ?? $errors->first() }}
</div>
@endif

<main class="max-w-7xl mx-auto px-4 sm:px-10 py-10">

    <!-- HEADER -->
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold">Users</h2>
            <p class="text-gray-600 mt-1">
                Manage all registered users
            </p>
        </div>

        <a href="{{ route('register') }}"
           class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 4v16m8-8H4"/>
            </svg>
            Create User
        </a>
    </div>

    <!-- DESKTOP TABLE -->
    <div class="hidden sm:block bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold uppercase">Name</th>
                        <th class="px-6 py-4 text-left font-semibold uppercase">Email</th>
                        <th class="px-6 py-4 text-left font-semibold uppercase">Date</th>
                        <th class="px-6 py-4 text-right font-semibold uppercase">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-5 font-medium">{{ $user->name }}</td>
                        <td class="px-6 py-5 text-gray-600 break-all">{{ $user->email }}</td>
                        <td class="px-6 py-5">
                            <span class="px-3 py-1 text-xs rounded-full bg-emerald-100 text-emerald-700">
                                {{ $user->created_at->format('d.m.Y') }}
                            </span>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex justify-end gap-5 items-center">
                                @if($user->id == 1)
                                    <span class="px-3 py-1 text-xs rounded-full bg-gray-200 text-gray-700">
                                        🔒 Admin
                                    </span>
                                @else
                                    <a href="{{ route('admin.user.edit-password', $user->id) }}"
                                       class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-800 font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('deleteKullanici', $user->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="inline-flex items-center gap-1.5 text-red-600 hover:text-red-800 font-medium">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center text-gray-400">
                            No users found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- MOBILE CARDS -->
    <div class="sm:hidden space-y-4">
        @forelse($users as $user)
            <div class="bg-white rounded-xl shadow-sm border p-5 space-y-4">

                <div>
                    <p class="font-semibold text-lg">{{ $user->name }}</p>
                    <p class="text-sm text-gray-600 break-all">{{ $user->email }}</p>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-xs px-3 py-1 rounded-full bg-emerald-100 text-emerald-700">
                        {{ $user->created_at->format('d.m.Y') }}
                    </span>

                    @if($user->id == 1)
                        <span class="text-xs px-3 py-1 rounded-full bg-gray-200 text-gray-700">
                            🔒 Admin
                        </span>
                    @endif
                </div>

                @if($user->id != 1)
                <div class="flex gap-3 pt-1">
                    <a href="{{ route('admin.user.edit-password', $user->id) }}"
                       class="flex-1 inline-flex items-center justify-center gap-2 text-sm py-2.5 rounded-lg text-blue-600 bg-blue-50 hover:bg-blue-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        Edit
                    </a>

                    <form method="POST" action="{{ route('deleteKullanici', $user->id) }}" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button
                            class="w-full inline-flex items-center justify-center gap-2 text-sm py-2.5 rounded-lg text-red-600 bg-red-50 hover:bg-red-100 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
                @endif
            </div>
        @empty
            <p class="text-center text-gray-400 py-10">No users found</p>
        @endforelse
    </div>

    <!-- PAGINATION -->
    @if($users->hasPages())
    <div class="mt-8">
        {{ $users->links() }}
    </div>
    @endif

</main>

</body>
</html>
</x-app-layout>