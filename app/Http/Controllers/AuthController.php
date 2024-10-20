<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required',
                'password' => 'required',
            ]);
            User::create($request->all());
            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ])) {
                return to_route('dashboard')->with('success', 'your are logged in successfully');
            } else {
                to_route('register');
            }
        }
        return view('auth.register');
    }
    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);
            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ])) {
                return to_route('dashboard')->with('success', 'your are logged in successfully');
            } else {
                return to_route('login')->with('error', 'Invalid login details...');
            }
        }
        return view('auth.login');
    }
    public function dashboard()
    {
        return view('auth.dashboard');
    }
    public function profile(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
            ]);

            $user = auth()->user();

            $user->update($validatedData);

            return redirect()->back()->with('success', 'Profile updated successfully!');
        }
        return view('auth.profile');
    }
    public function logout()
    {
        session::flush();
        Auth::logout();
        return to_route('login')->with('success', 'Logged out successfully');
    }
}
