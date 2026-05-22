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
                <h1 class="font-display text-4xl font-bold text-[var(--fg)] mb-2">Reset Password</h1>
                <p class="text-[var(--fg-muted)] text-lg">We'll send you a reset link</p>
            </div>

            <!-- Forgot Password Card -->
            <div class="luxury-card">
                <!-- Session Status -->
                <x-auth-session-status class="mb-6" :status="session('status')" />

                <div class="mb-6 text-[var(--fg-muted)] text-sm leading-relaxed">
                    Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                </div>

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-[var(--fg)] mb-2">
                            Email Address
                        </label>
                        <input id="email"
                               class="luxury-input"
                               type="email"
                               name="email"
                               :value="old('email')"
                               required
                               autofocus
                               placeholder="Enter your email">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Reset Button -->
                    <button type="submit" class="btn-luxury w-full justify-center text-center">
                        Send Reset Link
                    </button>
                </form>

                <!-- Back to Login Link -->
                <div class="mt-6 text-center">
                    <p class="text-[var(--fg-muted)] text-sm">
                        Remember your password?
                        <a href="{{ route('login') }}"
                           class="text-[var(--accent)] hover:text-[var(--accent-light)] transition-colors duration-200 font-medium">
                            Sign in here
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

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
