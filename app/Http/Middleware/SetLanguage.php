<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Setting\Entities\Language;
use Symfony\Component\HttpFoundation\Response;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lang = $request->route('lang') ?? $request->route('param');

        $defaultLang = Language::getDefault()->value;
        if ($lang === $defaultLang) {
            return redirect('/');
        }

        if ($lang) {
            $lang = Language::where('value', $lang)->value('value');
            if (!$lang) {
                $lang = $defaultLang;
            }
        } else {
            $lang = $defaultLang;
        }

        app()->setLocale($lang);

        return $next($request);
    }
}
