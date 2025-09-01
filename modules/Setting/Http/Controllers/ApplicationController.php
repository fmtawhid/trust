<?php

namespace Modules\Setting\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appsetting;
use App\Scopes\Asc;
use App\Traits\PictureResizeTrait;
use App\Traits\PictureTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Modules\Setting\Entities\Application;
use Modules\Setting\Entities\Currency;
use Modules\Setting\Entities\Language;
use Modules\Setting\Http\Requests\ApplicationRequest;

class ApplicationController extends Controller
{

    use PictureTrait, PictureResizeTrait;

    public function __construct()
    {
        $this->middleware('permission:read_application')->only('application');
        $this->middleware('permission:update_application')->only(['edit', 'update']);
        $this->middleware(['demo'])->only(['update']);
    }

    public function application()
    {
        $app        = Application::first();
        $langs      = Language::all();
        return view('setting::application', [
            'app'        => $app,
            'langs'      => $langs,
        ]);
    }

    public function update(ApplicationRequest $request, $id)
{
    $app = Application::findOrFail($id);

    // Map of all file fields and their current values
    $fileFields = [
        'logo' => $app->logo,
        'sidebar_logo' => $app->sidebar_logo,
        'sidebar_collapsed_logo' => $app->sidebar_collapsed_logo,
        'login_image' => $app->login_image,
        'footer_bg_image' => $app->footer_bg_img,
        'favicon' => $app->favicon,
        'footer_logo' => $app->footer_logo,
        'app_logo' => $app->app_logo,
        'mobile_menu_image' => $app->mobile_menu_image,
    ];

    $app->fill($request->except(array_keys($fileFields) + ['fixed_date']));

    foreach ($fileFields as $field => $oldFile) {
        if ($request->hasFile($field) && $request->file($field)->isValid()) {
            $requestFile = $request->file($field);
            $name = time() . '-' . $field . '.' . $requestFile->getClientOriginalExtension();

            // Delete old file if exists
            if (!empty($oldFile) && file_exists(public_path('storage/' . $oldFile))) {
                $this->deleteFile($oldFile);
            }

            // Ensure 'application' folder exists
            $folderPath = public_path('storage/application');
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0755, true);
            }

            // Move the uploaded file to public/storage/application
            $requestFile->move($folderPath, $name);

            // Optional: Resize image using Intervention
            Image::make($folderPath . '/' . $name)->save();

            // Save relative path in DB
            if ($field === 'footer_bg_image') {
                $app->footer_bg_img = 'application/' . $name;
            } else {
                $app->$field = 'application/' . $name;
            }
        }
    }

    // Update other fields
    $app->fixed_date = $request->fixed_date;
    $app->breaking_news_limit = $request->breaking_news_limit;
    $app->show_reporter_message = $request->show_reporter_message;
    $app->web_user_can_login = $request->web_user_can_login;
    $app->web_user_can_comment = $request->web_user_can_comment;
    $app->language_id = $request->default_language;
    $app->show_archive_post = $request->show_archive_post;
    $app->update();

    // Update Appsetting
    $app_settings = Appsetting::first();
    $app_settings_data = [
        'website_title'      => $app->title,
        'footer_text'        => $app->footer_text,
        'copy_right'         => $app->copy_right,
        'time_zone'          => $app->time_zone,
        'ltl_rtl'            => $app->rtl_ltr,
        'logo'               => $app->logo,
        'footer_logo'        => $app->footer_logo,
        'favicon'            => $app->favicon,
        'app_logo'           => $app->app_logo,
        'mobile_menu_image'  => $app->mobile_menu_image,
        'newstriker_status'  => $app->newstriker_status,
        'preloader_status'   => $app->preloader_status,
        'speed_optimization' => $app->speed_optimization,
        'language_id'        => $app->language_id,
    ];

    if ($app_settings) {
        $app_settings->update($app_settings_data);
    } else {
        Appsetting::create($app_settings_data);
    }

    // Set default language active
    $language = Language::findOrFail($request->default_language);
    $language->status = 1;
    $language->save();

    cache()->forget('defaultLanguage');
    cache()->forget('appSetting');
    cache()->forever('appSetting', $app);

    return redirect()->back()->with('success', localize('application_updated'));
}


    public function appSetting()
    {
        $app = Appsetting::first();
        return view('setting::app_setting', compact('app'));
    }

    public function updateAppSetting(Request $request)
    {
        Appsetting::updateOrCreate([
            'id' => 1,
        ], $request->all());

        Toastr::success(localize('app_setting_updated_successfully'));
        return redirect()->route('app.index');
    }

}
