<?php

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Enums\DateFormatEnum;
use App\Enums\AssetsFolderEnum;
use Modules\Theme\Entities\Theme;
use Illuminate\Support\Facades\Cache;
use Modules\Accounts\Entities\AccCoa;
use Illuminate\Support\Facades\Storage;
use Modules\Localize\Entities\Language;
use Modules\Accounts\Entities\AccVoucher;
use Modules\Setting\Entities\Application;
use Modules\UserManagement\Entities\PerMenu;
use Modules\Advertisement\Entities\Advertisement;
use voku\helper\ASCII;

/**
 * Generate asset URL
 */
function custom_asset(?string $file = null, ?string $default = null, ?string $path = null): string
{
    if ($file) {
        return app('url')->asset($path . '/' . $file . '?v=1');
    }
    return $default;
}

/**
 * Module asset URL
 */
function module_asset(?string $file = null, ?string $default = null): string
{
    return custom_asset($file, $default, 'module-assets');
}

if (!function_exists('age')) {
    function age($dob)
    {
        return Carbon::parse($dob)->age . " Years";
    }
}

function parentMenu($menuId)
{
    $menuDetail = PerMenu::where('id', $menuId)->first();
    return $menuDetail->menu_name ?? null;
}

if (!function_exists('app_setting')) {
    function app_setting()
    {
        $appSetting = Cache::remember('appSetting', 3600, function () {
            return Application::with('currency')->first();
        });

        $logos = [
            'logo' => 'assets/logo.png',
            'sidebar_logo' => 'assets/logo.png',
            'sidebar_collapsed_logo' => 'assets/mini-logo.png',
            'favicon' => 'assets/favicon.png',
            'login_image' => 'assets/logo.png',
            'footer_logo' => 'assets/footer-logo.png',
            'app_logo' => 'assets/logo.png',
            'mobile_menu_image' => 'assets/logo.png',
        ];

        foreach ($logos as $key => $default) {
            if (Storage::disk('public')->exists($appSetting->$key)) {
                $appSetting->$key = asset('storage/' . $appSetting->$key);
            } else {
                $appSetting->$key = asset($default);
            }
        }

        return $appSetting;
    }
}

if (!function_exists('currency')) {
    function currency()
    {
        return Cache::remember('currency', 3600, function () {
            $app = app_setting();
            return $app && $app->currency ? $app->currency->symbol : null;
        });
    }
}

if (!function_exists('logo_64_data')) {
    function logo_64_data()
    {
        $appSetting = Cache::remember('appSetting', 3600, fn() => Application::first());
        $logo = file_exists(asset($appSetting->logo)) ? 'storage/' . $appSetting->logo : __DIR__ . "/backend/assets/dist/img/logo-preview.png";

        if (file_exists($logo) && is_readable($logo)) {
            $type = pathinfo($logo, PATHINFO_EXTENSION);
            $data = file_get_contents($logo);
            return 'data:image/' . $type . ';base64,' . base64_encode($data);
        }
        return null;
    }
}

if (!function_exists('lang_setting')) {
    function lang_setting()
    {
        return cache()->remember('lang_setting', 120, fn() => Language::all());
    }
}

if (!function_exists('numberToWords')) {
    function numberToWords($number)
    {
        $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        return ucwords($f->format($number) . ' ' . app_setting()->currency->title . ' Only');
    }
}

if (!function_exists('numberToMillionBillion')) {
    function numberToMillionBillion($number = '')
    {
        if ($number >= 1000000000) return number_format($number / 1000000000, 2) . 'B';
        if ($number >= 1000000) return number_format($number / 1000000, 2) . 'M';
        if ($number >= 1000) return number_format($number / 1000, 2) . 'K';
        return number_format($number);
    }
}

if (!function_exists('current_date')) {
    function current_date()
    {
        return Carbon::today()->toDateString();
    }
}

if (!function_exists('current_date_for_account')) {
    function current_date_for_account()
    {
        $startDate = Carbon::today()->format('d/m/Y');
        $endDate = Carbon::today()->addDays(29)->format('d/m/Y');
        return "$startDate - $endDate";
    }
}

if (!function_exists('getVouchersByNo')) {
    function getVouchersByNo($voucher_no)
    {
        return Cache::remember($voucher_no, 3600, fn() => AccVoucher::where('voucher_no', $voucher_no)->get());
    }
}

if (!function_exists('orderByData')) {
    function orderByData($req = null)
    {
        return $req && ($req[0]["dir"] === "desc") ? "ASC" : "DESC";
    }
}

if (!function_exists('bt_number_format')) {
    function bt_number_format($number)
    {
        $type = app_setting()->floating_number;
        $negSymbol = app_setting()->negative_amount_symbol;
        $negative = false;

        if ($number < 0) {
            $negative = true;
            $number = abs($number);
        }

        $decimals = match($type) {
            1 => 0,
            2 => 1,
            3 => 2,
            4 => 3,
            default => 2,
        };

        $formatted = number_format((float) preg_replace('/[^\d.]/', '', $number), $decimals, '.', ',');
        if ($negative && $negSymbol == 2) $formatted = "($formatted)";
        if ($negative && $negSymbol != 2) $formatted = "-$formatted";

        return $formatted;
    }
}

if (!function_exists('isBankNature')) {
    function isBankNature($id)
    {
        return AccCoa::where('id', $id)->where('is_bank_nature', 1)->exists();
    }
}

if (!function_exists('check_expiry')) {
    function check_expiry(string $expiry_date, int $interval = null): bool
    {
        $today = Carbon::today();

        if ($interval) {
            $interval_date = Carbon::today()->addDays($interval);
            return Carbon::parse($expiry_date)->lte($interval_date) && Carbon::parse($expiry_date)->gt($today);
        }

        return Carbon::parse($expiry_date)->lt($today);
    }
}

function size_convert(int $size): string
{
    $unit = ['b', 'kb', 'mb', 'gb', 'tb', 'pb'];
    $i = floor(log($size, 1024));
    return round($size / pow(1024, $i), 2) . ' ' . $unit[$i];
}

function logNow(array $response = [], string $name = 'Default', string $log = 'error', string $user = null): void
{
    $user = $user ?? auth()->user();

    activity()
        ->causedBy($user)
        ->withProperties([
            'url' => request()->fullUrl(),
            'method' => request()->method(),
            'input' => request()->all(),
            'response' => $response,
        ])
        ->useLog($name)
        ->log($log);
}

// Localization helpers
function localize(?string $key, ?string $default_value = null, ?string $locale = null): ?string
{
    if (!$key) return '';
    return \App\Facades\Localizer::localize($key, $default_value, $locale);
}

function localize_uc(string $string): string { return ucwords(localize($string)); }
function localize_lower(string $string): string { return strtolower(localize($string)); }
function ___(?string $key, ?string $default_value = null, ?string $locale = null): ?string { return localize($key, $default_value, $locale); }
function get_phrases(?string $key, ?string $default_value = null, ?string $locale = null): ?string { return localize($key, $default_value, $locale); }

if (!function_exists("makeString")) {
    function makeString($data = [])
    {
        $output = "";
        foreach ($data as $i => $val) {
            $output .= ($i > 0 ? " " : "") . localize($val);
        }
        return $output;
    }
}

if (!function_exists('generate_positions')) {
    function generate_positions($start, $end) { return range($start, $end); }
}

if (!function_exists('get_date_picker_format')) {
    function get_date_picker_format(): string { return DateFormatEnum::YYYY_MM_DD->value; }
}

if (!function_exists('get_date_format')) {
    function get_date_format(): string { return DateFormatEnum::MM_DD_YYYY->value; }
}

if (!function_exists('assets')) {
    function assets($file = ''): string { return asset(AssetsFolderEnum::PUBLIC_ASSETS->value . '/' . $file); }
}

if (!function_exists('storage_asset_image')) {
    function storage_asset_image($file = ''): string
    {
        return file_exists(public_path('storage/' . $file)) ? asset(AssetsFolderEnum::STORAGE_ASSETS->value . '/' . $file) : asset('/assets/default.jpg');
    }
}

// Success/error/warning messages
function success_message(string $msg): void { toast($msg, 'success'); }
function error_message(string $msg): void { toast($msg, 'error'); }
function warning_message(string $msg): void { toast($msg, 'warning'); }

// Environment writer
function writeEnvFile(array $env, $path = __DIR__ . '/../../.env'): void
{
    $str = file_get_contents($path);

    foreach ($env as $key => $value) {
        $key_value = "$key=";
        $key_value .= is_numeric($value) || $value === 'true' || $value === 'false' ? $value : "\"$value\"";

        if (strpos($str, $key) !== false) {
            $str = preg_replace("/^$key=.*/m", $key_value, $str);
        } else {
            $str .= $key_value . PHP_EOL;
        }
    }

    file_put_contents($path, $str);
    \Illuminate\Support\Facades\Artisan::call('config:cache');
}

// Filesystem helpers
function storage_exist(string $filename = null): bool { return !empty($filename) && Storage::disk(env('FILESYSTEM_DISK', 'local'))->exists($filename); }
function current_file_system_disk(string $filename = null): string { return env('FILESYSTEM_DISK', 'local'); }

// API responses
function sendSuccessResponse($message, $result, $code=200){ return response()->json(['status'=>true,'code'=>$code,'message'=>$message,'data'=>$result], $code); }
function sendErrorResponse($errorMessage, $errorData=null, $code=404){ return response()->json(['status'=>false,'code'=>$code,'message'=>$errorMessage,'data'=>$errorData], $code); }

// URL helpers
function baseUrl() { return url('').'/'; }
function __url($path = '') {
    $lang = app()->getLocale();
    $defaultLang = Modules\Setting\Entities\Language::getDefault()->value;
    return $lang === $defaultLang ? url($path) : url($lang . '/' . ltrim($path, '/'));
}
function __url_story($directory = '', $path = '') {
    $lang = app()->getLocale();
    $defaultLang = Modules\Setting\Entities\Language::getDefault()->value;
    return $lang === $defaultLang ? url($directory.'/'.$path) : url($directory.'/'.$lang.'/'.ltrim($path, '/'));
}

function get_language_id()
{
    $locale = app()->getLocale();
    return Language::where('value', $locale)->first()?->id;
}

function news_publish_date_format(?string $date, string $format = 'F d, Y'): ?string
{
    if (!$date) return null;
    Carbon::setLocale(app()->getLocale());
    return convert_digits_to_locale(Carbon::parse($date)->translatedFormat($format), app()->getLocale());
}

function convert_digits_to_locale(string $string, string $locale): string
{
    if (!class_exists(\NumberFormatter::class)) return $string;
    return preg_replace_callback('/\d+/', fn($matches) => (new \NumberFormatter($locale, \NumberFormatter::DECIMAL))->format($matches[0]), $string);
}

function views_format(int $views): string
{
    if ($views >= 1000000) return number_format($views/1000000,2).'M';
    if ($views >= 1000) return number_format($views/1000,2).'K';
    return (string)$views;
}

function get_image_url(string $defaultPath, ?string $dbImagePath = null): string
{
    if ($dbImagePath && file_exists(public_path('storage/'.$dbImagePath))) return asset('storage/'.$dbImagePath);
    if (file_exists(public_path($defaultPath))) return asset($defaultPath);
    return asset('/assets/default.jpg');
}

function bgColorStyle($colorCode) { return 'style="background-color: #'.ltrim($colorCode,'#').';"'; }
function clean_news_content($value) { return mb_convert_encoding(preg_replace_callback('/&#(\d+);/', fn($m)=>mb_convert_encoding(pack('n',$m[1]),'UTF-8','UTF-16BE'), html_entity_decode(strip_tags($value))), 'UTF-8','UTF-8'); }

function get_advertisements(int $page, int $position)
{
    return Advertisement::select('embed_code')->with('themeRelation')->where('language_id', get_language_id())->where('page',$page)->where('ad_position',$position)->whereHas('themeRelation',fn($q)=>$q->where('is_active',1))->first();
}

function mode(): bool { return session()->get('mode')==='dark'; }

function activeTheme()
{
    return strtolower(Theme::where('is_active',1)->value('name') ?? abort(500,'No active theme found'));
}

function news_time_ago(?string $date): ?string
{
    if (!$date) return null;
    Carbon::setLocale(app()->getLocale());
    return convert_digits_to_locale(Carbon::parse($date)->diffForHumans(now(), true).' '.localize('ago'), app()->getLocale());
}

function generateSlug($title)
{
    if (!$title) return 'news-' . time();

    $locale = app()->getLocale();

    if (Str::startsWith($locale, 'en')) {
        // English slug
        $slug = Str::slug($title, '-') ?: 'news-' . time();
    } else {
        // Non-English slug
        $slug = preg_replace('/[^\p{L}\p{N}\s]+/u', '', $title); // remove punctuation
        $slug = preg_replace('/\s+/u', '-', trim($slug));        // spaces → hyphen
        $slug = preg_replace('/-+/', '-', $slug);                // remove consecutive hyphens
        $slug = trim($slug, '-') ?: 'news-' . time();            // trim hyphens
    }

    return $slug;
}


function manageVideoUrl($url)
{
    $src = $thumb = $renderType = null;

    if (Str::contains($url,['youtube.com/watch?v=','youtu.be'])){
        $videoId = Str::contains($url,'watch?v=') ? explode('&', explode('watch?v=',$url)[1])[0] : explode('youtu.be/',$url)[1];
        $src = "https://www.youtube.com/embed/$videoId?enablejsapi=1&controls=1&modestbranding=1&rel=0";
        $thumb = "https://img.youtube.com/vi/$videoId/hqdefault.jpg";
        $renderType = 'iframe';
    } elseif (Str::contains($url,'youtube.com/embed')){
        preg_match('/embed\/([^\?]+)/',$url,$matches);
        $videoId = $matches[1] ?? null;
        $src = $url;
        $thumb = $videoId ? "https://img.youtube.com/vi/$videoId/hqdefault.jpg" : null;
        $renderType = 'iframe';
    } elseif (Str::contains($url,'vimeo.com')){
        preg_match('/vimeo\.com\/(\d+)/',$url,$matches);
        $videoId = $matches[1] ?? null;
        $src = $videoId ? "https://player.vimeo.com/video/$videoId" : null;
        try { $vimeoData = $videoId ? json_decode(file_get_contents("https://vimeo.com/api/v2/video/$videoId.json")) : null; $thumb = $vimeoData[0]->thumbnail_large ?? null; } catch (\Exception $e){ $thumb=null; }
        $renderType='iframe';
    } elseif (Str::endsWith($url,'.mp4')){ $src=$url;$renderType='video'; }

    return ['src'=>$src,'type'=>$renderType,'thumb'=>$thumb];
}




if (!function_exists('bangla_date')) {
    function bangla_date($timestamp = null)
    {
        $timestamp = $timestamp ? strtotime($timestamp) : time();

        $bn_days = ['রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার', 'শনিবার'];
        $bn_months = [
            'বৈশাখ', 'জ্যৈষ্ঠ', 'আষাঢ়', 'শ্রাবণ', 'ভাদ্র', 'আশ্বিন',
            'কার্তিক', 'অগ্রহায়ণ', 'পৌষ', 'মাঘ', 'ফাল্গুন', 'চৈত্র'
        ];

        $en = ['0','1','2','3','4','5','6','7','8','9'];
        $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];

        // Gregorian date
        $date = getdate($timestamp);
        $g_day = $date['mday'];
        $g_month = $date['mon'];
        $g_year = $date['year'];
        $day_of_week = $date['wday']; // 0 = Sunday

        // Bangla year
        $bn_year = $g_year - 593;

        // Bangla months approximate start in Gregorian calendar
        $month_starts = [
            14, // বৈশাখ - April 14
            15, // জ্যৈষ্ঠ - May 15
            15, // আষাঢ় - June 15
            16, // শ্রাবণ - July 16
            16, // ভাদ্র - August 16
            16, // আশ্বিন - September 16
            17, // কার্তিক - October 17
            16, // অগ্রহায়ণ - November 16
            16, // পৌষ - December 16
            15, // মাঘ - January 15
            13, // ফাল্গুন - February 13
            15  // চৈত্র - March 15
        ];

        // Calculate Bangla month and date
        $bn_month = ($g_month + 8) % 12; // Start from April
        $bn_date = $g_day - $month_starts[$bn_month] + 1;

        if ($bn_date <= 0) {
            $bn_month = ($bn_month - 1 + 12) % 12;
            $bn_date = $g_day + (30 - $month_starts[$bn_month] + 1); // approximate
        }

        // Format
        $bn_date_str = str_replace($en, $bn, $bn_date);
        $bn_year_str = str_replace($en, $bn, $bn_year);
        $bn_day_name = $bn_days[$day_of_week];
        $bn_month_name = $bn_months[$bn_month];

        return "$bn_day_name, $bn_date_str $bn_month_name $bn_year_str বঙ্গাব্দ";
    }
}
