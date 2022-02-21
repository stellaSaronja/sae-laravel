<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [

            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only(['email','password']);

        if (auth()->attempt($credentials)) {

            return redirect()->route('postings.index')->with('info', 'Welcome dude!');

        } else {

            return redirect()->route('login')->with('error', 'Invalid credentials');
        }
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login')->with('info', 'Bye bye dude!');
    }
}
