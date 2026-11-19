<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Masukkan alamat email yang valid.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.string' => 'Kata sandi harus berupa teks.',
        ]);

        if (! Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], $request->boolean('remember'))) {
            if (! User::query()->where('email', $validated['email'])->exists()) {
                return back()->withErrors(['email' => 'Alamat email tidak terdaftar.']);
            }

            return back()->withErrors(['password' => 'Kata sandi yang Anda masukkan salah.']);
        }

        $user = Auth::user();
        $request->session()->regenerate();

        return $this->redirectUser($user);
    }

    /**
     * Log the user out and invalidate the session.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function redirectUser(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'tukang') {
            return redirect()->route('tukang.dashboard');
        }

        if ($user->role === 'pelanggan') {
            return redirect()->route('pelanggan.dashboard');
        }

        return redirect()->route('dashboard');
    }
}
