<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (auth()->attempt($credentials)) {
            // Check user role
            switch (auth()->user()->role->name) {
                case 'admin':
                    return redirect()->intended('/admin');
                case 'user':
                    return redirect()->intended('/user');
                default:
                    return redirect()->intended('/home');
            }
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => 2
        ]);

//        auth()->login($user);

        return redirect('/login');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
