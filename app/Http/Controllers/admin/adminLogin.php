<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminLogin extends Controller
{
    // protected $redirectTo = '/';

    // public function __construct()
    // {
    //     $this->middleware('guest:admin')->except('logout');
    // }

    public function login()
    {
        return view('admin/login');
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

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            toast('Login berhasil, Selamat datang kembali!', 'success', 'top-right');
            return redirect()->intended('/admin');
        }
        return back()->withErrors($credentials);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}