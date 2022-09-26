<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Validator;

class AdminController extends Controller
{

    public function redirect()
    {
        return Redirect()->route('login');
    }

    public function login()
    {
        return view('login');
    }

    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        // return redirect('/login');
        return back()->with([
            'alert' => 0,
            'message' => "Username atau password salah"
        ]);
    }

    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
