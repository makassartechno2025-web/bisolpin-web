<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    private function apiUrl($path)
    {
        return env('BISOLPIN_API_URL', 'https://admin.bisolpin.com') . $path;
    }

    public function profile()
    {
        $token = session('api_token');
        
        if (!$token) {
            return redirect()->route('login')->with('error', 'Sesi Anda telah berakhir, silakan login kembali.');
        }

        $response = Http::withToken($token)->get($this->apiUrl('/api/auth/me'));

        if ($response->successful()) {
            $userData = $response->json()['data'] ?? [];
            return view('student-profile', compact('userData'));
        }

        if ($response->status() === 401) {
            Auth::logout();
            session()->forget('api_token');
            return redirect()->route('login')->with('error', 'Sesi Anda telah berakhir, silakan login kembali.');
        }

        return redirect()->route('student-dashboard')->with('error', 'Gagal mengambil data profil dari API.');
    }

    public function dashboard()
    {
        $token = session('api_token');
        
        if (!$token) {
            return redirect()->route('login')->with('error', 'Sesi Anda telah berakhir, silakan login kembali.');
        }

        $response = Http::withToken($token)->get($this->apiUrl('/api/auth/me'));

        if ($response->successful()) {
            $userData = $response->json()['data'] ?? [];
            return view('student-dashboard', compact('userData'));
        }

        if ($response->status() === 401) {
            Auth::logout();
            session()->forget('api_token');
            return redirect()->route('login')->with('error', 'Sesi Anda telah berakhir, silakan login kembali.');
        }

        return view('student-dashboard', ['userData' => []])->with('error', 'Gagal mengambil data dashboard dari API.');
    }
}
