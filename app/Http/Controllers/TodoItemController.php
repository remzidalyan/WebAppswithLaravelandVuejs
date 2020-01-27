<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\TodoItem;

class TodoItemController extends Controller
{
    public function index(Request $request)
    {
        // return "dsadas";
        // return \App\TodoItem::all();
        // return TodoItem::all();
        //$todos = TodoItem::all();

        $todos = $request->user()->todos;
        //$todos = $request->user()->todos()->latest()->get();
        return view('todos',['todos'=> $todos]);
    }
    public function toggle(/*$id*/ TodoItem $todo, Request $request)
    {
        //$todo = TodoItem::findOrFail($id);
        if($request->user()->id != $todo->user_id) return abort(403);
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
        $todo->user_id = $request->user()->id;
        $todo->text = $request->todo;
        $todo->save();
        return redirect()->route('todos.all');
    }
}
