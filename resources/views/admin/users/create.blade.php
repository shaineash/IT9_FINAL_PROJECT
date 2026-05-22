<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-serif text-2xl text-[#f5f5f0] tracking-wide">
                Create New User
            </h2>
            <a href="{{ route('admin.users.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2 border border-[#2a2a2a] text-[#f5f5f0] text-sm font-medium rounded-lg hover:border-[#c9a77c] transition-colors duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Users
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <button onclick="history.back()" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0f0f0f] border border-[#2a2a2a] text-[#f5f5f0] rounded-xl hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 transition-colors duration-300 text-sm font-medium mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Go Back
        </button>

        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="luxury-form-card p-8">
                <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div class="space-y-2">
                        <label for="name" class="text-xs font-medium text-[#8a8a8a] uppercase tracking-wider ml-1">
                            Full Name
                        </label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            required
                            class="block w-full px-4 py-3.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-xl text-[#f5f5f0] placeholder-[#4a4a4a] focus:outline-none focus:border-[#c9a77c] focus:ring-2 focus:ring-[#c9a77c]/20 transition-all duration-300 hover:border-[#3a3a3a]"
                            placeholder="Enter full name"
                            value="{{ old('name') }}"
                        >
                        @error('name')
                            <p class="mt-1 text-xs text-red-400 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="text-xs font-medium text-[#8a8a8a] uppercase tracking-wider ml-1">
                            Email Address
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            required
                            class="block w-full px-4 py-3.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-xl text-[#f5f5f0] placeholder-[#4a4a4a] focus:outline-none focus:border-[#c9a77c] focus:ring-2 focus:ring-[#c9a77c]/20 transition-all duration-300 hover:border-[#3a3a3a]"
                            placeholder="Enter email address"
                            value="{{ old('email') }}"
                        >
                        @error('email')
                            <p class="mt-1 text-xs text-red-400 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="text-xs font-medium text-[#8a8a8a] uppercase tracking-wider ml-1">
                            Password
                        </label>
                        <div class="relative">
                            <input
                                id="password"
                                name="password"
                                type="password"
                                required
                                class="block w-full px-4 py-3.5 pr-12 bg-[#0f0f0f] border border-[#2a2a2a] rounded-xl text-[#f5f5f0] placeholder-[#4a4a4a] focus:outline-none focus:border-[#c9a77c] focus:ring-2 focus:ring-[#c9a77c]/20 transition-all duration-300 hover:border-[#3a3a3a]"
                                placeholder="Enter password"
                            >
                            <button
                                type="button"
                                onclick="togglePassword('password')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-[#8a8a8a] hover:text-[#c9a77c] transition-colors duration-200"
                            >
                                <svg id="password-eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-xs text-red-400 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="text-xs font-medium text-[#8a8a8a] uppercase tracking-wider ml-1">
                            Confirm Password
                        </label>
                        <div class="relative">
                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                required
                                class="block w-full px-4 py-3.5 pr-12 bg-[#0f0f0f] border border-[#2a2a2a] rounded-xl text-[#f5f5f0] placeholder-[#4a4a4a] focus:outline-none focus:border-[#c9a77c] focus:ring-2 focus:ring-[#c9a77c]/20 transition-all duration-300 hover:border-[#3a3a3a]"
                                placeholder="Confirm password"
                            >
                            <button
                                type="button"
                                onclick="togglePassword('password_confirmation')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-[#8a8a8a] hover:text-[#c9a77c] transition-colors duration-200"
                            >
                                <svg id="password_confirmation-eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <p class="mt-1 text-xs text-red-400 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="space-y-2">
                        <label for="role" class="text-xs font-medium text-[#8a8a8a] uppercase tracking-wider ml-1">
                            User Role
                        </label>
                        <select
                            id="role"
                            name="role"
                            required
                            class="block w-full px-4 py-3.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-2 focus:ring-[#c9a77c]/20 transition-all duration-300 hover:border-[#3a3a3a] appearance-none cursor-pointer"
                        >
                            <option value="user" {{ old('role', 'user') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role')
                            <p class="mt-1 text-xs text-red-400 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex gap-4 pt-6 border-t border-[#2a2a2a]">
                        <button
                            type="submit"
                            class="flex-1 group relative overflow-hidden py-4 px-6 rounded-xl shadow-lg transition-all duration-300 transform hover:scale-[1.01] active:scale-100"
                        >
                            <div class="absolute inset-0 bg-gradient-to-r from-[#c9a77c] via-[#d4af87] to-[#c9a77c] bg-[length:200%_100%] animate-shimmer"></div>
                            <div class="absolute inset-0 bg-gradient-to-r from-[#e8d5a7] to-[#c9a77c] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                            <span class="relative flex items-center justify-center gap-3 text-[#0f0f0f] font-semibold text-sm tracking-wider uppercase">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Create User
                            </span>
                        </button>

                        <a href="{{ route('admin.users.index') }}"
                           class="px-6 py-4 border border-[#2a2a2a] text-[#f5f5f0] rounded-xl hover:border-[#c9a77c] transition-colors duration-300 text-center">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + '-eye-icon');

            if (field.type === 'password') {
                field.type = 'text';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                `;
            } else {
                field.type = 'password';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                `;
            }
        }
    </script>
</x-app-layout>