<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Routing\Controller as BaseController;

class SettingsController extends BaseController
{

    public function index()
    {
        return view('setting', Settings::getSettings());
    }

    public function store(Request $request)
    {
        Settings::where('key', '!=', NULL)->delete();

        foreach ($request->all() as $key => $value) {
            if ($key != '_token') {
                $setting = new \App\Models\Settings();
                $setting->key = $key;
                $setting->value = $request->$key;
                $setting->save();
            }
        }
        return redirect()->route('settings.setting.index');
    }

}
