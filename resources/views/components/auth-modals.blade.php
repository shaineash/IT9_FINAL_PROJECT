<!-- Pure CSS Modal System - Uses :target selector, NO JavaScript -->

<!-- Login Modal -->
<div id="modal-login" class="modal-wrapper">
    <div class="modal-backdrop">
        <a href="#" class="absolute inset-0"></a>
    </div>
    <div class="modal-panel">
            <!-- Close button - just a link to # -->
            <a href="#" class="modal-close-btn">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </a>

            <div class="luxury-form-card relative overflow-hidden p-8 lg:p-10">
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-[#c9a77c] to-transparent"></div>
                
                <div class="text-center mb-8">
                    <div class="inline-flex items-center gap-2 mb-4">
                        <div class="w-2 h-2 bg-[#c9a77c] rounded-full animate-pulse"></div>
                        <span class="text-[#c9a77c] text-xs tracking-[0.2em] uppercase">Member Portal</span>
                    </div>
                    <h2 class="font-serif text-3xl text-[#f5f5f0] mb-2">Welcome Back</h2>
                    <p class="text-[#8a8a8a] text-sm">Sign in to continue your journey</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-6 p-4 rounded-xl bg-[#c9a77c]/10 border border-[#c9a77c]/20 text-[#c9a77c] text-sm flex items-center gap-2">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="login-email" class="text-xs font-medium text-[#8a8a8a] uppercase tracking-wider ml-1">
                            Email Address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-all duration-300 text-[#8a8a8a] group-focus-within:text-[#c9a77c]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                </svg>
                        </div>
                        <input 
                            id="login-email" 
                            name="email" 
                            type="email" 
                            autocomplete="email" 
                            required 
                            class="block w-full pl-11 pr-4 py-3.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-xl text-[#f5f5f0] placeholder-[#4a4a4a] focus:outline-none focus:border-[#c9a77c] transition-all duration-300 hover:border-[#3a3a3a]"
                            placeholder="you@example.com"
                            value="{{ old('email') }}"
                        >
                    </div>
                    @error('email')
                        <p class="mt-1 text-xs text-red-400 ml-1 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="login-password" class="text-xs font-medium text-[#8a8a8a] uppercase tracking-wider ml-1">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-all duration-300 text-[#8a8a8a] group-focus-within:text-[#c9a77c]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input 
                            id="login-password" 
                            name="password" 
                            type="password" 
                            autocomplete="current-password" 
                            required 
                            class="block w-full pl-11 pr-4 py-3.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-xl text-[#f5f5f0] placeholder-[#4a4a4a] focus:outline-none focus:border-[#c9a77c] transition-all duration-300 hover:border-[#3a3a3a]"
                            placeholder="••••••••"
                        >
                    </div>
                    @error('password')
                        <p class="mt-1 text-xs text-red-400 ml-1 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2.5 cursor-pointer group">
                        <input type="checkbox" name="remember" id="login-remember" 
                            class="w-4 h-4 rounded border-[#2a2a2a] bg-[#0f0f0f] text-[#c9a77c]">
                        <span class="text-sm text-[#8a8a8a] group-hover:text-[#f5f5f0] transition-colors">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-[#c9a77c] hover:text-[#e8d5a7] transition-colors hover:underline">
                        Forgot password?
                    </a>
                </div>

                <!-- Submit Button -->
                <div class="pt-3">
                    <button 
                        type="submit" 
                        class="w-full group relative overflow-hidden py-4 px-6 rounded-xl shadow-lg transition-all duration-300 transform hover:scale-[1.01] active:scale-100"
                    >
                        <div class="absolute inset-0 bg-gradient-to-r from-[#c9a77c] via-[#d4af87] to-[#c9a77c] bg-[length:200%_100%] animate-shimmer"></div>
                        <div class="absolute inset-0 bg-gradient-to-r from-[#e8d5a7] to-[#c9a77c] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <span class="relative flex items-center justify-center gap-2 text-[#0f0f0f] font-semibold text-sm tracking-wider uppercase">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Sign In
                        </span>
                    </button>
                </div>
            </form>

            <!-- Switch to Register -->
            <div class="mt-6 pt-6 border-t border-[#2a2a2a] text-center">
                <p class="text-sm text-[#8a8a8a]">
                    New to SEIN HELIOS?
                    <a href="#modal-register" class="font-medium text-[#c9a77c] hover:text-[#e8d5a7] transition-colors underline decoration-1 underline-offset-4">
                        Create account
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Registration Modal -->
<div id="modal-register" class="modal-wrapper">
    <div class="modal-backdrop">
        <a href="#" class="absolute inset-0"></a>
    </div>
    <div class="modal-panel">
            <a href="#" class="modal-close-btn">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </a>

            <div class="luxury-form-card relative overflow-hidden p-8 lg:p-10">
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-[#c9a77c] to-transparent"></div>
                
                <div class="text-center mb-8">
                    <div class="inline-flex items-center gap-2 mb-4">
                        <div class="w-2 h-2 bg-[#c9a77c] rounded-full animate-pulse"></div>
                        <span class="text-[#c9a77c] text-xs tracking-[0.2em] uppercase">Luxury Membership</span>
                    </div>
                    <h2 class="font-serif text-3xl text-[#f5f5f0] mb-2">Create Your Account</h2>
                    <p class="text-[#8a8a8a] text-sm">Join the SEIN HELIOS family</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div class="space-y-2">
                        <label for="reg-name" class="text-xs font-medium text-[#8a8a8a] uppercase tracking-wider ml-1">
                            Full Name
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-all duration-300 text-[#8a8a8a] group-focus-within:text-[#c9a77c]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <input 
                                id="reg-name" 
                                name="name" 
                                type="text" 
                                autocomplete="name" 
                                required 
                                class="block w-full pl-11 pr-4 py-3.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-xl text-[#f5f5f0] placeholder-[#4a4a4a] focus:outline-none focus:border-[#c9a77c] transition-all duration-300 hover:border-[#3a3a3a]"
                                placeholder="John Doe"
                                value="{{ old('name') }}"
                            >
                        </div>
                        @error('name')
                            <p class="mt-1 text-xs text-red-400 ml-1 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="reg-email" class="text-xs font-medium text-[#8a8a8a] uppercase tracking-wider ml-1">
                            Email Address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-all duration-300 text-[#8a8a8a] group-focus-within:text-[#c9a77c]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                </svg>
                            </div>
                            <input 
                                id="reg-email" 
                                name="email" 
                                type="email" 
                                autocomplete="email" 
                                required 
                                class="block w-full pl-11 pr-4 py-3.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-xl text-[#f5f5f0] placeholder-[#4a4a4a] focus:outline-none focus:border-[#c9a77c] transition-all duration-300 hover:border-[#3a3a3a]"
                                placeholder="you@example.com"
                                value="{{ old('email') }}"
                            >
                        </div>
                        @error('email')
                            <p class="mt-1 text-xs text-red-400 ml-1 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Role Selection -->
                    <div class="space-y-2">
                        <label for="reg-role" class="text-xs font-medium text-[#8a8a8a] uppercase tracking-wider ml-1">
                            Account Type
                        </label>
                        <select 
                            id="reg-role" 
                            name="role" 
                            required
                            onchange="toggleAdminCode(this.value)"
                            class="block w-full pl-4 pr-4 py-3.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-xl text-[#f5f5f0] placeholder-[#4a4a4a] focus:outline-none focus:border-[#c9a77c] transition-all duration-300 hover:border-[#3a3a3a] appearance-none cursor-pointer"
                        >
                            <option value="user" {{ old('role', 'user') !== 'admin' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role')
                            <p class="mt-1 text-xs text-red-400 ml-1 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Admin Code (Hidden by default) -->
                    <div class="space-y-2 {{ old('role') === 'admin' ? '' : 'hidden' }}" id="admin-code-field">
                        <label for="reg-admin-code" class="text-xs font-medium text-[#8a8a8a] uppercase tracking-wider ml-1">
                            Admin Code
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-all duration-300 text-[#8a8a8a] group-focus-within:text-[#c9a77c]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input 
                                id="reg-admin-code" 
                                name="admin_code" 
                                type="password" 
                                class="block w-full pl-11 pr-4 py-3.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-xl text-[#f5f5f0] placeholder-[#4a4a4a] focus:outline-none focus:border-[#c9a77c] transition-all duration-300 hover:border-[#3a3a3a]"
                                placeholder="Enter admin code"
                                value="{{ old('admin_code') }}"
                            >
                        </div>
                        @error('admin_code')
                            <p class="mt-1 text-xs text-red-400 ml-1 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="reg-password" class="text-xs font-medium text-[#8a8a8a] uppercase tracking-wider ml-1">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-all duration-300 text-[#8a8a8a] group-focus-within:text-[#c9a77c]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input 
                                id="reg-password" 
                                name="password" 
                                type="password" 
                                autocomplete="new-password" 
                                required 
                                class="block w-full pl-11 pr-4 py-3.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-xl text-[#f5f5f0] placeholder-[#4a4a4a] focus:outline-none focus:border-[#c9a77c] transition-all duration-300 hover:border-[#3a3a3a]"
                                placeholder="••••••••"
                            >
                        </div>
                        @error('password')
                            <p class="mt-1 text-xs text-red-400 ml-1 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-2">
                        <label for="reg-password-confirm" class="text-xs font-medium text-[#8a8a8a] uppercase tracking-wider ml-1">
                            Confirm Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-all duration-300 text-[#8a8a8a] group-focus-within:text-[#c9a77c]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input 
                                id="reg-password-confirm" 
                                name="password_confirmation" 
                                type="password" 
                                required 
                                class="block w-full pl-11 pr-4 py-3.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-xl text-[#f5f5f0] placeholder-[#4a4a4a] focus:outline-none focus:border-[#c9a77c] transition-all duration-300 hover:border-[#3a3a3a]"
                                placeholder="••••••••"
                            >
                        </div>
                        @error('password_confirmation')
                            <p class="mt-1 text-xs text-red-400 ml-1 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Terms -->
                    <div class="flex items-start gap-3 p-4 rounded-xl bg-[#0f0f0f]/50 border border-[#2a2a2a]/50">
                        <input 
                            type="checkbox" 
                            id="reg-terms" 
                            name="terms" 
                            required
                            class="mt-0.5 w-4 h-4 rounded border-[#2a2a2a] bg-[#0f0f0f] text-[#c9a77c]"
                        >
                        <label for="reg-terms" class="text-xs text-[#8a8a8a] leading-relaxed">
                            I agree to the <a href="#" class="text-[#c9a77c] hover:text-[#e8d5a7]">Terms</a> and <a href="#" class="text-[#c9a77c] hover:text-[#e8d5a7]">Privacy Policy</a>
                        </label>
                    </div>
                    @error('terms')
                        <p class="text-sm text-red-400 flex items-center gap-1.5 ml-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button 
                            type="submit" 
                            class="w-full group relative overflow-hidden py-4 px-6 rounded-xl shadow-lg transition-all duration-300 transform hover:scale-[1.01] active:scale-100"
                        >
                            <div class="absolute inset-0 bg-gradient-to-r from-[#c9a77c] via-[#d4af87] to-[#c9a77c] bg-[length:200%_100%] animate-shimmer"></div>
                            <div class="absolute inset-0 bg-gradient-to-r from-[#e8d5a7] to-[#c9a77c] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <span class="relative flex items-center justify-center gap-2 text-[#0f0f0f] font-semibold text-sm tracking-wider uppercase">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Create Account
                            </span>
                        </button>
                    </div>
                </form>

                <!-- Switch to Login -->
                <div class="mt-6 pt-6 border-t border-[#2a2a2a] text-center">
                    <p class="text-sm text-[#8a8a8a]">
                        Already a member?
                        <a href="#modal-login" class="font-medium text-[#c9a77c] hover:text-[#e8d5a7] transition-colors underline decoration-1 underline-offset-4">
                            Sign In
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- CSS Styles for Modals (Pure CSS - No JavaScript) -->
    <style>
        /* Shimmer animation for buttons */
        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        .animate-shimmer {
            animation: shimmer 3s linear infinite;
        }

        /* Modal wrapper - hidden by default */
        .modal-wrapper {
            position: fixed;
            inset: 0;
            z-index: 100;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        /* Show modal when targeted via URL hash */
        .modal-wrapper:target {
            visibility: visible;
            opacity: 1;
        }

        /* Backdrop - covers entire screen */
        .modal-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(15, 15, 15, 0.9);
            backdrop-filter: blur(4px);
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .modal-wrapper:target .modal-backdrop {
            opacity: 1;
        }

        /* Clickable backdrop overlay to close */
        .modal-backdrop a {
            position: absolute;
            inset: 0;
        }

        /* Modal panel - centered card */
        .modal-panel {
            position: relative;
            width: 100%;
            max-width: 28rem;
            max-height: calc(100vh - 4rem);
            margin: 0;
            transform: scale(0.95) translateY(20px);
            transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
            opacity: 0;
            pointer-events: none;
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 101;
        }

        .modal-wrapper:target .modal-panel {
            transform: scale(1) translateY(0);
            opacity: 1;
            pointer-events: auto;
        }

        /* Close button */
        .modal-close-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            color: #8a8a8a;
            cursor: pointer;
            transition: color 0.2s;
            z-index: 102;
        }
        .modal-close-btn:hover {
            color: #f5f5f0;
        }

        /* Fade-in animation for content */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }
    </style>

    <script>
        function toggleAdminCode(value) {
            const adminField = document.getElementById('admin-code-field');
            if (!adminField) return;

            if (value === 'admin') {
                adminField.classList.remove('hidden');
            } else {
                adminField.classList.add('hidden');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const roleSelect = document.getElementById('reg-role');
            if (roleSelect) {
                toggleAdminCode(roleSelect.value);
            }
        });
    </script>
