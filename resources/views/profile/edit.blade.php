<x-app-layout>
    <x-slot name="header">
        <div class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="rounded-[32px] border border-[#2a2a2a] bg-[#111111]/95 px-6 py-8 shadow-[0_30px_90px_rgba(0,0,0,0.55)] backdrop-blur-sm">
                    <p class="text-xs uppercase tracking-[0.35em] text-[#c9a77c]/80 mb-3">Profile</p>
                    <h1 class="font-display text-4xl sm:text-5xl font-semibold text-[#f5f5f0]">{{ auth()->user()->name }}</h1>
                    <p class="mt-3 max-w-3xl text-sm leading-7 text-[#8a8a8a]">Manage your SEIN HELIOS account details, secure access preferences, and membership settings in one elegant, premium dashboard.</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <button onclick="history.back()" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0f0f0f] border border-[#2a2a2a] text-[#f5f5f0] rounded-xl hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 transition-colors duration-300 text-sm font-medium mb-6 ml-4 sm:ml-6 lg:ml-8">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Go Back
        </button>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-6 xl:grid-cols-[1fr_390px]">
                <div class="space-y-6">
                    <section class="rounded-[32px] border border-[#2a2a2a] bg-[#111111] p-6 shadow-[0_30px_80px_rgba(0,0,0,0.55)]">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.35em] text-[#c9a77c]/75">Personal Information</p>
                                <h2 class="mt-3 text-2xl font-display font-semibold text-[#f5f5f0]">Account Snapshot</h2>
                            </div>
                        </div>

                        <div class="mt-8 grid gap-4 sm:grid-cols-2">
                            <div class="rounded-[24px] border border-[#2a2a2a] bg-[#0f0f0f] p-5">
                                <p class="text-xs uppercase tracking-[0.35em] text-[#8a8a8a]">Name</p>
                                <p class="mt-3 text-lg font-semibold text-[#f5f5f0]">{{ auth()->user()->name }}</p>
                            </div>
                            <div class="rounded-[24px] border border-[#2a2a2a] bg-[#0f0f0f] p-5">
                                <p class="text-xs uppercase tracking-[0.35em] text-[#8a8a8a]">Email</p>
                                <p class="mt-3 text-lg font-semibold text-[#f5f5f0]">{{ auth()->user()->email }}</p>
                            </div>
                            <div class="rounded-[24px] border border-[#2a2a2a] bg-[#0f0f0f] p-5">
                                <p class="text-xs uppercase tracking-[0.35em] text-[#8a8a8a]">Phone</p>
                                <p class="mt-3 text-lg font-semibold text-[#f5f5f0]">{{ auth()->user()->phone ?? __('Not Provided') }}</p>
                            </div>
                            <div class="rounded-[24px] border border-[#2a2a2a] bg-[#0f0f0f] p-5">
                                <p class="text-xs uppercase tracking-[0.35em] text-[#8a8a8a]">Account Status</p>
                                <p class="mt-3 text-lg font-semibold text-[#f5f5f0]">{{ ucfirst(auth()->user()->role ?? 'Member') }}</p>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-[32px] border border-[#2a2a2a] bg-[#111111] p-6 shadow-[0_30px_80px_rgba(0,0,0,0.55)] hover:-translate-y-0.5 transition-transform duration-300">
                        @include('profile.partials.update-profile-information-form')
                    </section>

                    <section class="rounded-[32px] border border-[#2a2a2a] bg-[#111111] p-6 shadow-[0_30px_80px_rgba(0,0,0,0.55)] hover:-translate-y-0.5 transition-transform duration-300">
                        @include('profile.partials.update-password-form')
                    </section>
                </div>

                <aside class="space-y-6">
                    <section class="rounded-[32px] border border-[#2a2a2a] bg-[#111111] p-6 shadow-[0_30px_80px_rgba(0,0,0,0.55)]">
                        <p class="text-xs uppercase tracking-[0.35em] text-[#c9a77c]/75">Account Actions</p>
                        <h2 class="mt-3 text-2xl font-display font-semibold text-[#f5f5f0]">Security Controls</h2>
                        <p class="mt-4 text-sm leading-6 text-[#8a8a8a]">Use these actions to keep your membership secure, or to remove your account if needed.</p>
                        <div class="mt-6 flex flex-col gap-4">
                            @include('profile.partials.delete-user-form')
                            <form method="POST" action="{{ route('logout') }}" class="rounded-[24px] border border-[#2a2a2a] bg-[#0f0f0f] p-4">
                                @csrf
                                <button type="submit" class="w-full rounded-full bg-[#c9a77c] px-5 py-3 text-sm font-semibold uppercase tracking-[0.2em] text-[#0f0f0f] shadow-[0_18px_50px_rgba(201,167,124,0.15)] hover:bg-[#e8d5a7] transition">{{ __('Log Out') }}</button>
                            </form>
                        </div>
                    </section>
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>
