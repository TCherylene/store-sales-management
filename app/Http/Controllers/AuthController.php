<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function show()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return back()->withErrors(['username' => 'Login gagal']);
        }

        if ($user->opt_status != User::OPT_STATUS_ACTIVE) {
            return back()->withErrors(['username' => 'Login gagal']);
        }

        Auth::login($user);

        return redirect()->intended(route('home'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
