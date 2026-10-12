<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Kredensial statis (sementara — belum pakai DB).
     */
    private const USERS = [
        [
            'email'    => 'admin@rentcar.id',
            'password' => 'admin123',
            'name'     => 'Administrator',
            'role'     => 'admin',
        ],
        [
            'email'    => 'user@rentcar.id',
            'password' => 'user123',
            'name'     => 'Penyewa',
            'role'     => 'user',
        ],
    ];

    /**
     * Tampilkan halaman login.
     */
    public function showLogin(): View|RedirectResponse
    {
        if (session('user')) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Proses login.
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);

        $email    = strtolower(trim($request->input('email')));
        $password = trim($request->input('password'));

        $user = collect(self::USERS)->first(
            fn(array $u) => strtolower($u['email']) === $email
        );

        if (!$user || $user['password'] !== $password) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Email atau password salah.']);
        }

        session([
            'user' => [
                'email' => $user['email'],
                'name'  => $user['name'],
                'role'  => $user['role'],
            ],
        ]);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Selamat datang, ' . $user['name'] . '!');
    }

    /**
     * Logout.
     */
    public function logout(): RedirectResponse
    {
        session()->forget('user');
        session()->invalidate();
        session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Anda berhasil logout.');
    }
}
