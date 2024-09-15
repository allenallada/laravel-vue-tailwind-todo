<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Todo;

class ValidateTodoExists
{
    public function handle(Request $request, Closure $next)
    {
        $todo = Todo::find($request->route('id'));
        if (!$todo) {
            return response()->json(['error' => 'Todo not found'], 404);
        }

        return $next($request);
    }
}
