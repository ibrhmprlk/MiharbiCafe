<script type="text/javascript">
    // Eğer kullanıcı geri tuşuna basarsa sayfayı yenilemeye zorlar
    window.onpageshow = function(event) {
        if (event.persisted) {
            window.location.reload();
        }
    };
</script>

<x-guest-layout>
    <h1 class="text-5xl font-semibold text-center mb-4">
        Login
    </h1>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="'web@site.cafe'"
                required
                autofocus
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                :value="'123456789'"
                required
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Buttons -->
        <div class="flex items-center justify-between mt-6">
            <!-- Dashboard Button -->
            <a
                href="{{ route('home') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium
                       text-gray-700 bg-gray-100 rounded-lg
                       hover:bg-gray-200 transition"
            >
                Dashboard
            </a>

            <!-- Login Button -->
            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
