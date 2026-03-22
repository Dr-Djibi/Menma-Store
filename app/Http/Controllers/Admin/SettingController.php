<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key');
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $settingsData = $request->input('settings', []);
        
        // Gérer les uploads
        if ($request->hasFile('shop_logo')) {
            $path = $request->file('shop_logo')->store('public/branding');
            $settingsData['shop_logo'] = str_replace('public/', '/storage/', $path);
        }

        if ($request->hasFile('pwa_icon')) {
            $path = $request->file('pwa_icon')->store('public/branding');
            $settingsData['pwa_icon'] = str_replace('public/', '/storage/', $path);
        }

        foreach ($settingsData as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return back()->with('success', 'Réglages mis à jour !');
    }
}
