<x-guest-layout>
    <!-- Background Pattern -->
    <div class="bg-pattern"></div>

    <!-- Floating particles background -->
    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="particle" style="top: 20%; left: 10%; animation-delay: 0s;"></div>
        <div class="particle" style="top: 60%; left: 80%; animation-delay: 5s;"></div>
        <div class="particle" style="top: 80%; left: 30%; animation-delay: 10s;"></div>
        <div class="particle" style="top: 40%; left: 70%; animation-delay: 15s;"></div>
        <div class="particle" style="top: 10%; left: 50%; animation-delay: 20s;"></div>
    </div>

    <div class="relative z-10 min-h-screen flex items-center justify-center px-4 py-12">
        <div class="max-w-md w-full">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="font-display text-4xl font-bold text-[var(--fg)] mb-2">Join Us</h1>
                <p class="text-[var(--fg-muted)] text-lg">Create your account</p>
            </div>

            <!-- Register Card -->
            <div class="luxury-card">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-[var(--fg)] mb-2">
                            Full Name
                        </label>
                        <input id="name"
                               class="luxury-input"
                               type="text"
                               name="name"
                               value="{{ old('name') }}"
                               required
                               autofocus
                               autocomplete="name"
                               placeholder="Enter your full name">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-[var(--fg)] mb-2">
                            Email Address
                        </label>
                        <input id="email"
                               class="luxury-input"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autocomplete="username"
                               placeholder="Enter your email">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-[var(--fg)] mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <input id="password"
                                class="luxury-input pr-14 password-input"
                                   type="password"
                                   name="password"
                                   required
                                   minlength="8"
                                   autocomplete="new-password"
                                   placeholder="Create a password">
                            <button type="button"
                                    data-password-toggle="password"
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
                        <p class="password-helper mt-2 text-sm text-[#8a8a8a]" data-password-helper-for="password">Password must contain at least 8 characters.</p>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-[var(--fg)] mb-2">
                            Confirm Password
                        </label>
                        <div class="relative">
                            <input id="password_confirmation"
                                class="luxury-input pr-14 password-input"
                                   type="password"
                                   name="password_confirmation"
                                   required
                                   minlength="8"
                                   autocomplete="new-password"
                                   placeholder="Confirm your password">
                            <button type="button"
                                    data-password-toggle="password_confirmation"
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
                        <p class="password-helper mt-2 text-sm text-[#8a8a8a]" data-password-helper-for="password_confirmation">Password must contain at least 8 characters.</p>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Role Selection -->
                    <div>
                        <label class="block text-sm font-medium text-[var(--fg)] mb-3">
                            Account Type
                        </label>
                        <div class="space-y-2">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" 
                                       name="role" 
                                       value="user" 
                                       {{ old('role', 'user') === 'user' ? 'checked' : '' }}
                                       onchange="toggleAdminCode()"
                                       class="w-4 h-4">
                                <span class="ml-3 text-sm text-[var(--fg)]">Guest Account</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" 
                                       name="role" 
                                       value="admin" 
                                       {{ old('role') === 'admin' ? 'checked' : '' }}
                                       onchange="toggleAdminCode()"
                                       class="w-4 h-4">
                                <span class="ml-3 text-sm text-[var(--fg)]">Administrator Account</span>
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <!-- Admin Code (Hidden by default) -->
                    <div id="admin-code-section" class="hidden" style="display: {{ old('role') === 'admin' ? 'block' : 'none' }}">
                        <label for="admin_code" class="block text-sm font-medium text-[var(--fg)] mb-2">
                            Admin Security Code
                        </label>
                        <input id="admin_code"
                               class="luxury-input"
                               type="password"
                               name="admin_code"
                               value="{{ old('admin_code') }}"
                               placeholder="Enter admin security code"
                               autocomplete="off">
                        <p class="text-xs text-[var(--fg-muted)] mt-2">
                            Required to register as an administrator. If incorrect, you will be registered as a guest.
                        </p>
                        <x-input-error :messages="$errors->get('admin_code')" class="mt-2" />
                    </div>

                    <!-- Register Button -->
                    <button type="submit" class="btn-luxury w-full justify-center text-center">
                        Create Account
                    </button>
                </form>

                <!-- Login Link -->
                <div class="mt-6 text-center">
                    <p class="text-[var(--fg-muted)] text-sm">
                        Already have an account?
                        <a href="{{ route('login') }}"
                           class="text-[var(--accent)] hover:text-[var(--accent-light)] transition-colors duration-200 font-medium">
                            Sign in here
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleAdminCode() {
            const adminCodeSection = document.getElementById('admin-code-section');
            const roleRadios = document.getElementsByName('role');
            const isAdmin = Array.from(roleRadios).find(radio => radio.checked)?.value === 'admin';
            
            if (isAdmin) {
                adminCodeSection.style.display = 'block';
            } else {
                adminCodeSection.style.display = 'none';
            }
        }
    </script>

    <style>
        /* Floating particles animation */
        .particle {
            position: fixed;
            width: 2px;
            height: 2px;
            background: var(--accent);
            border-radius: 50%;
            opacity: 0.3;
            animation: float 20s infinite ease-in-out;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0); opacity: 0.3; }
            25% { transform: translateY(-100px) translateX(50px); opacity: 0.6; }
            50% { transform: translateY(-50px) translateX(-30px); opacity: 0.4; }
            75% { transform: translateY(-150px) translateX(20px); opacity: 0.5; }
        }

        /* Subtle background pattern */
        .bg-pattern {
            position: fixed;
            inset: 0;
            background-image:
                radial-gradient(ellipse 80% 50% at 50% -20%, rgba(201, 167, 124, 0.08), transparent),
                radial-gradient(ellipse 60% 40% at 100% 100%, rgba(201, 167, 124, 0.05), transparent);
            pointer-events: none;
            z-index: 0;
        }

        /* Luxury Card */
        .luxury-card {
            background: var(--card);
            border: 1px solid var(--border);
            padding: 48px;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .luxury-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--accent), transparent);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .luxury-card:hover {
            border-color: rgba(201, 167, 124, 0.3);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .luxury-card:hover::before {
            opacity: 1;
        }

        /* Luxury Input */
        .luxury-input {
            width: 100%;
            padding: 16px 20px;
            background: var(--bg-elevated);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--fg);
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            transition: all 0.3s ease;
            outline: none;
        }

        .luxury-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(201, 167, 124, 0.1);
        }

        .luxury-input::placeholder {
            color: var(--fg-muted);
        }

        /* Luxury Buttons */
        .btn-luxury {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 18px 48px;
            background: transparent;
            border: 1px solid var(--accent);
            color: var(--accent);
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            cursor: pointer;
            overflow: hidden;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            width: 100%;
        }

        .btn-luxury::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            transform: translateY(100%) scaleX(0.8);
            transform-origin: center;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: -1;
        }

        .btn-luxury:hover {
            color: var(--bg);
            border-color: var(--accent-light);
            box-shadow: 0 0 30px rgba(201, 167, 124, 0.3);
            transform: translateY(-2px);
        }

        .btn-luxury:hover::before {
            transform: translateY(0) scaleX(1);
        }

        .btn-luxury:active {
            transform: scale(0.98) translateY(0);
        }
    </style>
</x-guest-layout>
