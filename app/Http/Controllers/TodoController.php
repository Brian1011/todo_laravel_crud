<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all todos
        $todos = Todo::all();

        // return the todos as JSON
        return response()->json($todos, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//
        // validate the request
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'task_category_id' => 'required|integer',
        ]);

        // get the authenticated user
        $user = auth()->user();

        // create a new todo
        $todo = Todo::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'description' => $request->description,
            'task_category_id' => $request->task_category_id,
            'due_date' => $request->due_date ?? null,
        ]);

        // return the todo as JSON
        return response()->json($todo, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
