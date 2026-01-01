<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput($request->only('email'));
    }

    /**
     * Registration
     */
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
        ]);

        return redirect()->route('auth.login')->with('success', 'Account created successfully');
    }

    /**
     * Reset password
     */

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user){
            return back()->withErrors([
                'email'=>'Email not found'
            ]);
        }
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('auth.login')->with('success', 'Password reset successfully');
    }

    /**
     * Log out
     */

    public function logout(){
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
