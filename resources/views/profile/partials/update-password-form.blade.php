<section>
    <header>
        <div class="flex flex-col gap-2">
            <p class="text-xs uppercase tracking-[0.35em] text-[#c9a77c]/75">Password Settings</p>
            <h2 class="text-2xl font-display font-semibold text-[#f5f5f0]">Update Password</h2>
            <p class="text-sm text-[#8a8a8a]">Keep your account secure by choosing a strong password only you can access.</p>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-semibold uppercase tracking-[0.2em] text-[#e8d5b7]">{{ __('Current Password') }}</label>
            <div class="relative mt-2">
                <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                    class="w-full rounded-[24px] border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3 text-[#f5f5f0] placeholder-[#6e6e6e] focus:border-[#c9a77c] focus:ring-2 focus:ring-[#c9a77c]/20 outline-none transition password-input" />
                <button type="button"
                        data-password-toggle="update_password_current_password"
                        aria-label="Show password"
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-[#8a8a8a] hover:text-[#c9a77c] transition-colors">
                    <svg class="password-toggle-show w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg class="password-toggle-hide hidden w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.052 10.052 0 012.223-3.607m2.3-1.844A9.969 9.969 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.02 10.02 0 01-4.56 5.37" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                    </svg>
                </button>
            </div>
            <p class="password-helper mt-2 text-sm text-[#8a8a8a]" data-password-helper-for="update_password_current_password">Password must contain at least 8 characters.</p>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-semibold uppercase tracking-[0.2em] text-[#e8d5b7]">{{ __('New Password') }}</label>
            <div class="relative mt-2">
                <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                    class="w-full rounded-[24px] border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3 text-[#f5f5f0] placeholder-[#6e6e6e] focus:border-[#c9a77c] focus:ring-2 focus:ring-[#c9a77c]/20 outline-none transition password-input" />
                <button type="button"
                        data-password-toggle="update_password_password"
                        aria-label="Show password"
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-[#8a8a8a] hover:text-[#c9a77c] transition-colors">
                    <svg class="password-toggle-show w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg class="password-toggle-hide hidden w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.052 10.052 0 012.223-3.607m2.3-1.844A9.969 9.969 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.02 10.02 0 01-4.56 5.37" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                    </svg>
                </button>
            </div>
            <p class="password-helper mt-2 text-sm text-[#8a8a8a]" data-password-helper-for="update_password_password">Password must contain at least 8 characters.</p>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-semibold uppercase tracking-[0.2em] text-[#e8d5b7]">{{ __('Confirm Password') }}</label>
            <div class="relative mt-2">
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                    class="w-full rounded-[24px] border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3 text-[#f5f5f0] placeholder-[#6e6e6e] focus:border-[#c9a77c] focus:ring-2 focus:ring-[#c9a77c]/20 outline-none transition password-input" />
                <button type="button"
                        data-password-toggle="update_password_password_confirmation"
                        aria-label="Show password"
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-[#8a8a8a] hover:text-[#c9a77c] transition-colors">
                    <svg class="password-toggle-show w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg class="password-toggle-hide hidden w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.052 10.052 0 012.223-3.607m2.3-1.844A9.969 9.969 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.02 10.02 0 01-4.56 5.37" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                    </svg>
                </button>
            </div>
            <p class="password-helper mt-2 text-sm text-[#8a8a8a]" data-password-helper-for="update_password_password_confirmation">Password must contain at least 8 characters.</p>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col items-start gap-4 sm:flex-row sm:items-center">
            <x-primary-button class="rounded-full bg-[#c9a77c] px-8 py-3 text-sm text-[#0f0f0f] hover:bg-[#e8d5a7] focus:ring-[#c9a77c]/40">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-[#c9a77c]">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
