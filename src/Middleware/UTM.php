<?php

namespace Flamix\Apps24LaravelLead\Middleware;

use Closure;
use Flamix\Bitrix24\Trace;
use Illuminate\Http\Request;

/** Records UTM, click ids (gclid, ttclid) and visited pages for the lead sent later. */
class UTM
{
    public function handle(Request $request, Closure $next)
    {
        // Pages only for real page views: Livewire and other XHR posts are not pages.
        if ($request->isMethod('GET') && ! $request->ajax()) {
            // URL from Laravel: Trace reads $_SERVER['HTTP_HOST'], which test requests do not fill.
            Trace::init('/' . ltrim($request->path(), '/'), $request->fullUrl());
        }

        return $next($request);
    }
}
