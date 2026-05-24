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
            </div>
            <div class="mt-3 flex items-center gap-3 text-sm text-[#8a8a8a]">
                <input id="show-password-update-current" type="checkbox" data-show-password-target="update_password_current_password"
                    class="h-4 w-4 rounded border-[#8a8a8a] bg-[#1a1a1a] text-[#c9a77c] focus:ring-[#c9a77c]" />
                <label for="show-password-update-current" class="select-none">Show Password</label>
            </div>
            <p class="password-helper mt-2 text-sm text-[#8a8a8a]" data-password-helper-for="update_password_current_password">Password must contain at least 8 characters.</p>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-semibold uppercase tracking-[0.2em] text-[#e8d5b7]">{{ __('New Password') }}</label>
            <div class="relative mt-2">
                <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                    class="w-full rounded-[24px] border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3 text-[#f5f5f0] placeholder-[#6e6e6e] focus:border-[#c9a77c] focus:ring-2 focus:ring-[#c9a77c]/20 outline-none transition password-input" />
            </div>
            <div class="mt-3 flex items-center gap-3 text-sm text-[#8a8a8a]">
                <input id="show-password-update-new" type="checkbox" data-show-password-target="update_password_password"
                    class="h-4 w-4 rounded border-[#8a8a8a] bg-[#1a1a1a] text-[#c9a77c] focus:ring-[#c9a77c]" />
                <label for="show-password-update-new" class="select-none">Show Password</label>
            </div>
            <p class="password-helper mt-2 text-sm text-[#8a8a8a]" data-password-helper-for="update_password_password">Password must contain at least 8 characters.</p>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-semibold uppercase tracking-[0.2em] text-[#e8d5b7]">{{ __('Confirm Password') }}</label>
            <div class="relative mt-2">
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                    class="w-full rounded-[24px] border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3 text-[#f5f5f0] placeholder-[#6e6e6e] focus:border-[#c9a77c] focus:ring-2 focus:ring-[#c9a77c]/20 outline-none transition password-input" />
            </div>
            <div class="mt-3 flex items-center gap-3 text-sm text-[#8a8a8a]">
                <input id="show-password-update-confirm" type="checkbox" data-show-password-target="update_password_password_confirmation"
                    class="h-4 w-4 rounded border-[#8a8a8a] bg-[#1a1a1a] text-[#c9a77c] focus:ring-[#c9a77c]" />
                <label for="show-password-update-confirm" class="select-none">Show Password</label>
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
