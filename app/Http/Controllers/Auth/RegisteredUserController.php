<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate base registration fields
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['nullable', 'in:user,admin'],
            'admin_code' => ['nullable', 'string'],
        ]);

        // Default to regular user registration.
        $role = 'user';

        if (! empty($validated['role']) && $validated['role'] === 'admin') {
            // Check if admin code is provided and valid
            if (empty($validated['admin_code'])) {
                return redirect()->back()->withInput()->withErrors([
                    'admin_code' => 'Admin security code is required to register as an administrator.',
                ]);
            }

            $correctAdminCode = config('app.admin_code', 'ADMIN2025');
            if ($validated['admin_code'] !== $correctAdminCode) {
                return redirect()->back()->withInput()->withErrors([
                    'admin_code' => 'The provided admin security code is invalid.',
                ]);
            }

            $role = 'admin';
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $role,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
