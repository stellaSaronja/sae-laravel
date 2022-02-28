<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mail;

class AuthController extends Controller
{
    public function signup()
    {
        return view('auth.signup');
    }

    public function postSignup(Request $request)
    {
        $this->validate($request, [

            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $user = new User($request->all());
        $user->password = bcrypt($request->get('password'));
        $user->remember_token = Str::random(60);
        $user->save();

        Mail::send('emails.activate', compact('user'), function($mail) use($user) {

            $mail->to($user->email, $user->name)->subject('Activate your account');
        });

        return redirect()->route('postings.index')->with('info', 'Signup successfull!');
    }

    public function activate($token)
    {
        $user = User::where('remember_token', $token)->first();

        if (!$user) {

            abort(404);
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('postings.index')->with('info', 'Activation successfull!');
    }

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
        $remember_me = $request->has('remember_me');

        if (auth()->attempt($credentials, $remember_me)) {

            if (empty(auth()->user()->email_verified_at)) {

                auth()->logout();
                return redirect()->route('login')->with('error', 'Account not activated');
            }

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
