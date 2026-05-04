<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomAuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }
        return view('login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return $this->redirectBasedOnRole();
        }

        return redirect()->route('login')->with('error', 'Email atau password salah.');
    }

    public function registration()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }
        return view('register');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role
        ]);

        Auth::login($user);

        return $this->redirectBasedOnRole();
    }

    public function signOut()
    {
        Auth::logout();
        return redirect('login');
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }
        return redirect('login')->with('error', 'Opps! You do not have access');
    }

    private function redirectBasedOnRole()
    {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang di Panel Admin!');
        }
        // Redirect normal users to homepage or user dashboard
        return redirect('/');
    }
}
