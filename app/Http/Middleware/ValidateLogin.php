<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateLogin
{
    public function handle(Request $request, Closure $next)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        return $next($request);
    }
}
