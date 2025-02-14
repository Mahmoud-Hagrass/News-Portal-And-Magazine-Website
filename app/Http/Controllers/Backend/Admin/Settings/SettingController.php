<?php

namespace App\Http\Controllers\Backend\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Admin\Settings\UpdateSettingRequest;
use App\Models\Setting;
use App\Utils\Frontend\ImageManager;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {
        return view('backend.admin.settings.index');
    }

    public function update(UpdateSettingRequest $request)
    {
        try {
            DB::beginTransaction() ; 
            $request->validated();
            $site_setting = Setting::findOrFail(1);
            $setting = $site_setting->update($request->except(['_token', '_method', 'logo', 'favicon']));
            if (!$setting) {
                display_error_message('Error Try Again!');
                return redirect()->route('admin.settings.index');
            }
            if ($request->hasFile('logo')) {
                ImageManager::customDeleteImage($site_setting, 'logo', 'uploads');
                ImageManager::customeUploadImage($request, $site_setting, 'logo', 'logo', 'settings', 'uploads');
            }
            if ($request->hasFile('favicon')) {
                ImageManager::customDeleteImage($site_setting, 'favicon', 'uploads');
                ImageManager::customeUploadImage($request, $site_setting, 'favicon', 'favicon', 'settings', 'uploads');
            }
            DB::commit();
            display_success_message('Setting Updated Successfully!');
            return redirect()->route('admin.settings.index');
        } catch (Exception $e) {
            DB::rollBack();
            display_error_message('Error Try Again!');
            return redirect()->route('admin.settings.index');
        }
    }
}
