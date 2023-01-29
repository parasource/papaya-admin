<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function index()
    {
        $settings = Setting::all();
        return view('admin.settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $setting = Setting::create([
            'key' => $request['key'],
            'value' => $request['value']
        ]);

        return redirect()->route('admin.settings.index');
    }

    public function create()
    {
        return view('admin.settings.create');
    }

    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }


    public function update(Request $request, Setting $setting)
    {
        $setting->update([
            'value' => $request['value']
        ]);
    }


    public function destroy(Setting $setting)
    {
        $setting->delete();

        return redirect()->route('admin.settings.index');
    }
}
