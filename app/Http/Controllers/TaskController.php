<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorize(Task::class. 'task');
    }

    public function index(Request $request) 
    {
        // Filter using 3rd party query builder
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters('is_done')
            ->defaultSort('-created_at')
            ->allowedSorts(['title', 'is_done', 'created_at'])
            ->paginate();
            
        // Return the task collection from the task resource
        return new TaskCollection($tasks);
    }

    public function show(Request $request, Task $task) 
    {
        return new TaskResource($task);
    }

    public function store(StoreTaskRequest $request) 
    {
        $validated = $request->validated();

        $task = Auth::user()->tasks()->create($validated);
        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, Task $task) 
    {
        $validated = $request->validated();

        $task->update($validated);

        return new TaskResource($task);
    }

    public function destroy(Request $request, Task $task) 
    {
        $task->delete();
        
        return response()->noContent();
    }
}