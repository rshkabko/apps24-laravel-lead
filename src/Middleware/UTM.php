<?php

namespace Flamix\Apps24LaravelLead\Middleware;

use Closure;

class UTM
{
    public function handle($request, Closure $next)
    {
        \Flamix\Bitrix24\SmartUTM::init();
        return $next($request);
    }
}
