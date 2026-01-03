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

    public function authenticate(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

if (Auth::attempt($credentials)) {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('dashboard.admin');
    } elseif ($user->role === 'staff') {
        return redirect()->route('dashboard.staff');
    }

    // User role not recognized
    Auth::logout();
    return redirect()->back()->withErrors(['email' => 'Your role is not recognized']);
}

// Invalid credentials
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
            'role'=>'required|in:admin,staff',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'=> $request->name,
            'role'=> $request->role,
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
