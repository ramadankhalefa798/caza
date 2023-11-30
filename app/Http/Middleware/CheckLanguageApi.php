<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Closure;
use Illuminate\Http\Request;

class CheckLanguageApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    use GeneralTrait;

    public function handle(Request $request, Closure $next)
    {
        $languages = $this->getLocales();

        app()->setLocale('ar');

        if ($request->header('lang') && in_array($request->header('lang'), $languages)) {
            app()->setLocale($request->header('lang'));
        }

        return $next($request);
    }
}
