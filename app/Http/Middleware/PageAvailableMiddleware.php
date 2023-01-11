<?php

namespace App\Http\Middleware;

use App\Facades\Repository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageAvailableMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        abort_if(!$this->isPageAvailable($request->route()->controller->getCode() ?? ''), 404);

        return $next($request);
    }

    private function isPageAvailable(string $code): bool
    {
        return !is_null(Repository::sitePage()->getByCode($code)) && !is_null(Auth::user()) &&
            Auth::user()->checkAccessPage($code);
    }
}
