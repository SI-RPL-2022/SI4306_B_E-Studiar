<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('user/register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'tgl_lahir' => 'required|max:255',
            'jenjang_pendidikan' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        alert()->success('Registrasi berhasil', 'Registration Success! Silakan login untuk melanjutkan');
        return redirect('/user/login')->with('success', 'Registration Succesfull! Please Login');
    }
}