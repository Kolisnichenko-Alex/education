<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Reader
{
    private $auth;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->auth = auth()->user() ?
            ((auth()->user()->account_type === 'admin') ||
            (auth()->user()->account_type === 'publisher') ||
            (auth()->user()->account_type === 'reader')) : false;

        if ($this->auth === true)
            return $next($request);

        return redirect()->route('login')->with('error', 'Access denied, login to continue.');
    }
}
