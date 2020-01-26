<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\TodoItem;

class TodoItemController extends Controller
{
    public function index()
    {
        // return "dsadas";
        // return \App\TodoItem::all();
        // return TodoItem::all();
        $todos = TodoItem::all();
        return view('todos',['todos'=> $todos]);
    }
    public function toggle(/*$id*/ TodoItem $todo)
    {
        //$todo = TodoItem::findOrFail($id);
        $todo->toggle();
        $todo->save();
        return redirect()->route('todos.all');
    }
    public function store(Request $request)
    {
        $request->validate([
            'todo' => 'required|string|min:3|max:250'
        ]);

        $todo = new TodoItem;
        $todo->text = $request->todo;
        $todo->save();
        return redirect()->route('todos.all');
    }
}
