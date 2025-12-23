<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function showLoginForm()
    {
        return view('login.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Tentukan apakah login menggunakan email atau username
        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        // Data credentials
        $credentials = [
            $fieldType => $request->login,
            'password' => $request->password,
        ];

        // Coba login
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            // Redirect ke dashboard
            return redirect()->intended(route('dashboard'));
        }

        // Jika login gagal
        throw ValidationException::withMessages([
            'login' => __('auth.failed'),
        ]);
    }

    /*** Logout*/
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        // $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}