<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Auth::user()->todos;
        return response()->json($todos);
    }

    public function create(Request $request)
    {
        $todo = Todo::create([
            'todo' => $request->todo,
            'is_completed' => $request->is_completed ?? false,
            'user_id' => Auth::id(),
        ]);

        return response()->json($todo, 201);
    }

    public function update(Request $request, $id)
    {
        $todo = Auth::user()->todos()->findOrFail($id);
        $todo->update($request->only([
            'todo',
            'is_completed'
        ]));

        return response()->json($todo);
    }

    public function delete($id)
    {
        $todo = Auth::user()->todos()->findOrFail($id);
        $todo->delete();

        return response()->json(['id' => $id]);
    }
}