<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function registerUser(Request $request)
    {

        $rules = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $rules['password'] = bcrypt($rules['password']);
        $set = Admin::create($rules);

        if ($set) {
            return redirect('/login')->with([
                "alert" => '1',
                "message" => "Pendaftaran Berhasil"
            ]);
        } else {
            return redirect('/login')->with([
                "alert" => '0',
                "message" => "Pendaftaran Gagal"
            ]);
        }
    }
}
