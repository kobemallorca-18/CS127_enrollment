<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $redirectTo = '/home';
    
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication successful
            return redirect()->intended(route('home'));
        }

        // Invalid username and password combination
        return redirect()->back()->withErrors(['message' => 'Invalid username and password combination.']);
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    public function logout()
    {
        $this->guard()->logout();

        return redirect('/login');
    }
}
