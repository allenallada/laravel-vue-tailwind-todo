<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ValidateTodo
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $request->validate([
                'todo' => 'required|string|max:255',
                'is_completed' => 'boolean',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        return $next($request);
    }
}
