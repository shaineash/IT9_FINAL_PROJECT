<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative mt-1">
                <x-text-input id="password" class="block w-full pr-4"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>
            <div class="mt-3 flex items-center gap-3 text-sm text-[var(--fg-muted)]">
                <input id="show-password-confirm" type="checkbox" data-show-password-target="password"
                    class="h-4 w-4 rounded border-[#8a8a8a] bg-[#1a1a1a] text-[#c9a77c] focus:ring-[#c9a77c]" />
                <label for="show-password-confirm" class="select-none">Show Password</label>
            </div>
            <p class="password-helper mt-2 text-sm text-[#8a8a8a]">Password must contain at least 8 characters.</p>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
