<?php

namespace App\Http\Middleware;

use App\Facades\Repository;
use Closure;
use Illuminate\Http\Request;

class PageAvailableMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        abort_if(is_null(Repository::sitePage()->findByCode($request->route()->controller->code ?? '')), 404);

        return $next($request);
    }
}
