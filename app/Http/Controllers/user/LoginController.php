<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('user/login', [
            'title' => 'Masuk Estudiar'
        ]);
    }

    public function authenticate(Request $request)
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            toast('Login berhasil, Selamat datang kembali!', 'success', 'top-right');
            return redirect()->intended('/');
        }
        toast('Login gagal, pastikan email & password tepat!', 'error', 'top-right');
        return back()->with('loginError', 'Login failed');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}