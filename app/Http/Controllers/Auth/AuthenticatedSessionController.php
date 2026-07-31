<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Proses login user.
     */
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (!Auth::attempt($credentials, $remember)) {
            return back()
                ->withErrors([
                    'email' => 'Email atau password yang dimasukkan salah.',
                ])
                ->onlyInput('email');
        }

       $request->session()->regenerate();

$user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | REDIRECT BERDASARKAN ROLE
        |--------------------------------------------------------------------------
        */

        // ADMIN
        if (
            (method_exists($user, 'hasRole') && $user->hasRole('admin'))
            || ($user->role ?? null) === 'admin'
        ) {
            return redirect()->route('admin.dashboard');
        }

        // KASIR
        if (
            (method_exists($user, 'hasRole') && $user->hasRole('kasir'))
            || ($user->role ?? null) === 'kasir'
        ) {
            return redirect()->route('kasir.dashboard');
        }

        // PELANGGAN
        if (
            (method_exists($user, 'hasRole') && $user->hasRole('pelanggan'))
            || ($user->role ?? null) === 'pelanggan'
        ) {
            return redirect()->route('pelanggan.dashboard');
        }

        // Jika tidak punya role
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->withErrors([
                'email' => 'Akun Anda belum memiliki role yang valid.',
            ]);
    }

    /**
     * Logout.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
