<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectWww
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $host = $request->getHost();
        
        // Redirect from non-www to www
        if ($host !== 'www.trustnews.press' && $host !== 'localhost' && strpos($host, ':') === false) {
            return redirect($request->getScheme() . '://www.' . $host . $request->getRequestUri(), 301);
        }

        return $next($request);
    }
}
