<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::pluck('value', 'key');
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $keys = [
            'site_name', 'site_tagline', 'site_phone', 'site_email',
            'site_address', 'site_whatsapp', 'social_instagram', 'social_facebook', 'social_youtube',
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                SiteSetting::set($key, $request->input($key));
            }
        }

        return redirect()->route('admin.settings')->with('success', 'Pengaturan berhasil disimpan!');
    }
}
