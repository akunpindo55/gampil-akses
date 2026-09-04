<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        try {
            if (Auth::check()) {
                return redirect()->route('admin.dashboard');
            }
        } catch (\Throwable) {
            // Proceed to login view if session check fails
        }

        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        try {
            // Auto-check and migrate if users table is missing
            if (!Schema::hasTable('users')) {
                Artisan::call('migrate', ['--force' => true]);
                Artisan::call('db:seed', ['--force' => true]);
            }

            // If no admin user exists, auto-seed with configured/default credentials
            $adminEmail = env('ADMIN_EMAIL', 'admin@r4ven.local');
            $adminPassword = env('ADMIN_PASSWORD', 'admin12345');

            if (User::where('role', 'admin')->count() === 0) {
                User::create([
                    'name' => 'R4VEN Operator',
                    'email' => $adminEmail,
                    'password' => Hash::make($adminPassword),
                    'role' => 'admin',
                ]);
            }

            // Attempt login
            if (Auth::attempt($credentials, $remember)) {
                try {
                    $request->session()->regenerate();
                } catch (\Throwable) {}

                if (Auth::user()->role === 'admin') {
                    return redirect()->intended(route('admin.dashboard'));
                }

                return redirect()->route('landing');
            }

            // Check if matching fallback admin credentials
            if ($credentials['email'] === $adminEmail && $credentials['password'] === $adminPassword) {
                $user = User::updateOrCreate(
                    ['email' => $adminEmail],
                    [
                        'name' => 'R4VEN Operator',
                        'password' => Hash::make($adminPassword),
                        'role' => 'admin',
                    ]
                );

                Auth::login($user, $remember);
                return redirect()->route('admin.dashboard');
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');

        } catch (\Throwable $e) {
            return back()->withErrors([
                'email' => 'Database error: ' . $e->getMessage() . '. Please verify your DATABASE_URL in Vercel Environment Variables.',
            ])->onlyInput('email');
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        } catch (\Throwable) {}

        return redirect()->route('login');
    }
}
