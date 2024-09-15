<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        return Todo::all();
    }

    public function create(Request $request)
    {
        $todo = Todo::create([
            'todo' => $request->todo,
            'is_completed' => $request->is_completed ?? false,
        ]);

        return response()->json($todo, 201);
    }

    public function update(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->update($request->only([
            'todo',
            'is_completed'
        ]));

        return response()->json($todo);
    }

    public function delete($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return response()->json(['id' => $id]);
    }
}
