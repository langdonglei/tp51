<?php

namespace app\http\middleware;

use app\api\service\TokenService;

class Auth
{
    public function handle($request, \Closure $next, $level)
    {
        if (!TokenService::auth($level)) {
            throw new \Exception('forbidden');
        }
        return $next($request);
    }
}
