
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

<body class="min-h-screen bg-gray-50 text-gray-800 overflow-y-scroll">

<form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
    @csrf
</form>

<!-- CONTENT -->
<main class="max-w-7xl mx-auto px-10 py-10">
    <x-slot name="header">
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800">
            Update Profile for {{ $user->name }}
        </h2>

        <a href="{{ route('kullanicilar') }}"
           class="inline-flex items-center gap-2 text-sm font-medium
                  text-blue-600 hover:text-blue-800 transition">
            ← Back to Users
        </a>
    </div>
</x-slot>
    

    <section class="mt-6">
<form method="POST"
      action="{{ route('admin.user.update-password', $user->id) }}"
      class="space-y-6">
    @csrf
    @method('PUT')
    
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $user->name) }}" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ old('email', $user->email) }}" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('New Password')" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Password Confirmation -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if(session('status') === 'password-updated')
                <p class="text-sm text-green-600 mt-2">Profile updated successfully!</p>
            @endif
        </form>
    </section>


</main>

</body>
</html>
</x-app-layout>
