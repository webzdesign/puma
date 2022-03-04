<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public $route = 'settings';
    public $view = 'admin.settings';
    public $moduleName = 'Settings';

    public function index()
    {
        $moduleName = $this->moduleName;
        $setting = Setting::first();
        return view($this->view . '/index', compact('moduleName', 'setting'));
    }

    public function update(Request $request)
    {
        // logo
        if ($request->has('logo')) {
            $logoName = 'logo_' . random_int(1, 100) . '.' . $request->logo->extension();
            $request->logo->move(storage_path('app/logo'), $logoName);
            if ($request->old_logo != 'logo.jpg') {
                if ($request->old_logo != '' || $request->old_logo != null) {
                    if (file_exists(storage_path('app/logo/' . $request->old_logo))) {
                        unlink(storage_path('app/logo/' . $request->old_logo));
                    }
                }
            }
        } else {
            $logoName = $request->old_logo;
        }

        //   favicon
        if ($request->has('favicon')) {
            $faviconName = 'favicon_' . random_int(1, 100) . '.' . $request->favicon->extension();
            $request->favicon->move(storage_path('app/favicon'), $faviconName);
            if ($request->old_favicon != 'favicon.jpg') {
                if ($request->old_favicon != '' || $request->old_favicon != null) {
                    if (file_exists(storage_path('app/favicon/' . $request->old_favicon))) {
                        unlink(storage_path('app/favicon/' . $request->old_favicon));
                    }
                }
            }
        } else {
            $faviconName = $request->old_favicon;
        }
        Setting::updateOrCreate(['id' => 1], ['name' => trim(strtoupper($request->title)), 'logo' => ($logoName == '') ? '' : $logoName, 'favicon' => ($faviconName == null) ? '' : $faviconName]);
        Helper::successMsg('update', $this->moduleName);

        Session::forget('title');
        $setting = Setting::first();
        Session()->put('logo', $setting->logo);
        Session()->put('title', $setting->title);
        Session()->put('favicon', $setting->favicon);
        return back();
    }
}
