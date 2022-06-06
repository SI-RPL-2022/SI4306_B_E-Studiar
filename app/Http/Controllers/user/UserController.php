<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile($id)
    {
        $users = User::find($id);
        return view('user/profile', compact('users'));
    }
}