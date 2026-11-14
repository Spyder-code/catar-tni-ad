<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureSuperadmin
{
    public function handle(Request $request, Closure $next)
    {
        abort_unless($request->user() && $request->user()->isSuperadmin(), 403);

        return $next($request);
    }
}
