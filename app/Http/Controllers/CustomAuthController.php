<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CustomAuthController extends Controller
{
    private function apiUrl($path)
    {
        return env('BISOLPIN_API_URL', 'https://admin.bisolpin.com') . $path;
    }

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

        $response = Http::post($this->apiUrl('/api/auth/login'), [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            // Handle multiple possible API response structures
            $tokenData = $data['data'] ?? $data;
            $token     = $tokenData['token'] ?? $tokenData['access_token'] ?? $data['token'] ?? $data['access_token'] ?? null;
            $userData  = $tokenData['user'] ?? $data['user'] ?? null;

            if ($token && $userData) {
                // Auto-promote if email is in ADMIN_EMAILS env
                $adminEmails = array_map('trim', explode(',', env('ADMIN_EMAILS', '')));
                $isAdmin = in_array(strtolower($userData['email']), array_map('strtolower', $adminEmails));
                $role = $isAdmin ? 'admin' : ($userData['role'] ?? 'user');

                // Mirror user locally
                $user = User::updateOrCreate(
                    ['email' => $userData['email']],
                    [
                        'name'     => $userData['name'],
                        'password' => Hash::make(Str::random(24)),
                        'role'     => $role,
                    ]
                );

                Auth::login($user);
                session(['api_token' => $token]);

                return $this->redirectBasedOnRole();
            }
        } elseif ($response->status() === 403 && isset($response->json()['errors']['needs_verification'])) {
            session(['verification_email' => $request->email]);
            return redirect()->route('otp')->with('info', 'Silakan verifikasi email Anda dengan OTP yang telah dikirim.');
        }

        // Show the actual API error message (or a fallback)
        $message = $response->json('message') ?? $response->json('error') ?? 'Email atau password salah.';
        // Avoid showing success-sounding messages as login errors
        if (stripos($message, 'success') !== false) {
            $message = 'Terjadi kesalahan format respons. Silakan coba lagi.';
        }
        return redirect()->route('login')->with('error', $message);
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
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $username = explode('@', $request->email)[0] . rand(100, 999);

        $response = Http::post($this->apiUrl('/api/auth/register'), [
            'name' => $request->name,
            'username' => $username,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password,
        ]);

        if ($response->status() === 201 || $response->successful()) {
            session(['verification_email' => $request->email]);
            return redirect()->route('otp')->with('success', 'Registrasi berhasil. Silakan cek email Anda untuk OTP.');
        }

        if ($response->status() === 422) {
            $errors = $response->json('errors');
            $firstError = \Illuminate\Support\Arr::first($errors)[0] ?? 'Validasi gagal.';
            return redirect()->back()->with('error', $firstError)->withInput();
        }

        return redirect()->back()->with('error', $response->json('message') ?? 'Terjadi kesalahan saat registrasi.')->withInput();
    }

    public function otpView()
    {
        if (!session('verification_email')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        return view('otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp1' => 'required|numeric',
            'otp2' => 'required|numeric',
            'otp3' => 'required|numeric',
            'otp4' => 'required|numeric',
            'otp5' => 'required|numeric',
            'otp6' => 'required|numeric',
        ]);

        $otp = $request->otp1 . $request->otp2 . $request->otp3 . $request->otp4 . $request->otp5 . $request->otp6;
        
        // Wait, the API requires 4 digits or 6 digits? My test returned "Invalid or expired OTP" for 000000. Let me check the view first, I will just accept 'otp' array or combine it.
        $email = session('verification_email');
        if (!$email) {
            return redirect()->route('login')->with('error', 'Sesi telah habis, silakan login kembali.');
        }

        $response = Http::post($this->apiUrl('/api/auth/verify-account'), [
            'email' => $email,
            'otp' => $otp,
        ]);

        if ($response->successful()) {
            session()->forget('verification_email');
            return redirect()->route('login')->with('success', 'Verifikasi berhasil! Silakan login.');
        }

        return redirect()->back()->with('error', $response->json('message') ?? 'OTP tidak valid atau kadaluarsa.');
    }

    public function resendOtp(Request $request)
    {
        $email = session('verification_email');
        if (!$email) {
            return redirect()->route('login');
        }

        $response = Http::post($this->apiUrl('/api/auth/resend-otp'), [
            'email' => $email
        ]);

        return redirect()->back()->with('success', 'OTP telah dikirim ulang ke email Anda.');
    }

    public function googleLoginWeb(Request $request)
    {
        $accessToken = $request->input('access_token');
        if (!$accessToken) {
            return redirect()->route('login')->with('error', 'Token Google tidak ditemukan.');
        }

        $response = Http::post($this->apiUrl('/api/auth/google-login'), [
            'access_token' => $accessToken
        ]);

        if ($response->successful()) {
            $data = $response->json();
            
            if (isset($data['data']['token'])) {
                $token = $data['data']['token'];
                $userData = $data['data']['user'];

                // Auto-promote if email is in ADMIN_EMAILS env
                $adminEmails = array_map('trim', explode(',', env('ADMIN_EMAILS', '')));
                $isAdmin = in_array(strtolower($userData['email']), array_map('strtolower', $adminEmails));
                $role = $isAdmin ? 'admin' : ($userData['role'] ?? 'user');
                
                // Mirror user
                $user = User::updateOrCreate(
                    ['email' => $userData['email']],
                    [
                        'name'     => $userData['name'],
                        'password' => Hash::make(\Illuminate\Support\Str::random(24)),
                        'role'     => $role,
                    ]
                );
                
                Auth::login($user);
                session(['api_token' => $token]);
                
                return $this->redirectBasedOnRole();
            }
        }

        return redirect()->route('login')->with('error', $response->json('message') ?? 'Login dengan Google gagal.');
    }

    public function signOut()
    {
        if (session('api_token')) {
            Http::withToken(session('api_token'))->post($this->apiUrl('/api/auth/logout'));
        }
        
        Auth::logout();
        session()->forget('api_token');
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
        return redirect('/');
    }
}
