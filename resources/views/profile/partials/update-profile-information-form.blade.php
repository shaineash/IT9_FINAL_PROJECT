<section>
    <header>
        <div class="flex flex-col gap-2">
            <p class="text-xs uppercase tracking-[0.35em] text-[#c9a77c]/75">Account Settings</p>
            <h2 class="text-2xl font-display font-semibold text-[#f5f5f0]">Update Profile</h2>
            <p class="text-sm text-[#8a8a8a]">Keep your contact information current and ensure your account details are secure.</p>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('patch')

        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <label for="name" class="block text-sm font-semibold uppercase tracking-[0.2em] text-[#e8d5b7]">{{ __('Name') }}</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                    class="mt-2 w-full rounded-[24px] border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3 text-[#f5f5f0] placeholder-[#6e6e6e] focus:border-[#c9a77c] focus:ring-2 focus:ring-[#c9a77c]/20 outline-none transition" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold uppercase tracking-[0.2em] text-[#e8d5b7]">{{ __('Email') }}</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                    class="mt-2 w-full rounded-[24px] border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3 text-[#f5f5f0] placeholder-[#6e6e6e] focus:border-[#c9a77c] focus:ring-2 focus:ring-[#c9a77c]/20 outline-none transition" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-3 rounded-[24px] border border-[#2a2a2a] bg-[#0f0f0f] p-4 text-sm text-[#c9a77c]">
                        <p>{{ __('Your email address is unverified.') }}</p>
                        <button form="send-verification" class="mt-3 inline-flex rounded-full border border-[#c9a77c] bg-transparent px-4 py-2 text-sm font-semibold text-[#c9a77c] hover:bg-[#c9a77c]/10 transition">{{ __('Click here to re-send the verification email.') }}</button>
                    </div>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-3 text-sm text-[#c9a77c]">{{ __('A new verification link has been sent to your email address.') }}</p>
                    @endif
                @endif
            </div>
        </div>

        <div class="flex flex-col items-start gap-4 sm:flex-row sm:items-center">
            <x-primary-button class="rounded-full bg-[#c9a77c] px-8 py-3 text-sm text-[#0f0f0f] hover:bg-[#e8d5a7] focus:ring-[#c9a77c]/40">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-[#c9a77c]">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
