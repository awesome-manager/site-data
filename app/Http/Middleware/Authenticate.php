<?php

namespace App\Http\Middleware;

use Awesome\Connector\Contracts\Status;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        try {
            if ($this->auth->guard($guard)->guest()) {
                return response('Unauthorized.', Status::UNAUTHORIZED);
            }
        } catch (\Exception $e) {
            return response('Server Error.', Status::SERVER_ERROR);
        }

        return $next($request);
    }
}
