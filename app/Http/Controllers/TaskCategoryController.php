<?php

namespace App\Http\Controllers;

use App\Models\TaskCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all task categories
        $taskCategories = TaskCategory::all();

        // return the task categories as JSON
        return response()->json($taskCategories, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(
                ['errors' => $validator->errors()->all()], 422);
        }

        // create a new task category
        $taskCategory = TaskCategory::create([
            'name' => $request->name,
        ]);

        // return the task category as JSON
        return response()->json($taskCategory, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskCategory $taskCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskCategory $taskCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskCategory $taskCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskCategory $taskCategory)
    {
        //
    }
}
