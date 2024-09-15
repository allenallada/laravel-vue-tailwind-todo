<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Todo;

class ValidateUpdateTodo
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the todo item exists
        $todo = Todo::find($request->route('id'));
        if (!$todo) {
            return response()->json(['error' => 'Todo not found'], 404);
        }

        try {
            $request->validate([
                'todo' => 'sometimes|required|string|max:255',
                'is_completed' => 'sometimes|boolean',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        return $next($request);
    }
}
