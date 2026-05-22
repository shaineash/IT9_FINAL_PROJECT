<section class="space-y-6">
    <header>
        <div class="flex flex-col gap-2">
            <p class="text-xs uppercase tracking-[0.35em] text-[#c9a77c]/75">Account Removal</p>
            <h2 class="text-2xl font-display font-semibold text-[#f5f5f0]">Delete Account</h2>
            <p class="text-sm text-[#8a8a8a]">Permanently delete your account and all associated data. This action cannot be undone.</p>
        </div>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="rounded-full bg-[#7f1d1d] px-6 py-3 text-sm font-semibold uppercase tracking-[0.18em] text-white hover:bg-[#991b1b] focus:ring-[#991b1b]/40"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 space-y-6 rounded-[28px] bg-[#111111] border border-[#2a2a2a] shadow-[0_30px_70px_rgba(0,0,0,0.65)]">
            @csrf
            @method('delete')

            <div class="space-y-3">
                <h2 class="text-xl font-semibold text-[#f5f5f0]">{{ __('Are you sure you want to delete your account?') }}</h2>
                <p class="text-sm text-[#8a8a8a]">{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}</p>
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold uppercase tracking-[0.18em] text-[#e8d5b7]">{{ __('Password') }}</label>
                <input id="password" name="password" type="password" placeholder="{{ __('Password') }}"
                    class="mt-3 w-full rounded-[24px] border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3 text-[#f5f5f0] placeholder-[#6e6e6e] focus:border-[#c9a77c] focus:ring-2 focus:ring-[#c9a77c]/20 outline-none transition" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                <x-secondary-button x-on:click="$dispatch('close')" class="rounded-full bg-[#1f1f1f] border border-[#2a2a2a] text-[#f5f5f0] hover:bg-[#2a2a2a] focus:ring-[#c9a77c]/30">{{ __('Cancel') }}</x-secondary-button>
                <x-danger-button class="rounded-full bg-[#7f1d1d] px-6 py-3 text-sm font-semibold uppercase tracking-[0.18em] text-white hover:bg-[#991b1b] focus:ring-[#991b1b]/40">{{ __('Delete Account') }}</x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
