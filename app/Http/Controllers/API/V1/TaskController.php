<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\PaginatedResource;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetTaskRequest $request)
    {
        $task = Task::search($request->search)
            ->latest()
            ->paginate($request->limit ?? 10);

        return ApiResponse::success(
            new PaginatedResource($task, TaskResource::class),
            'Task List'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->validated());

        return ApiResponse::success(
            new TaskResource($task),
            'Task created successfully',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return ApiResponse::error(
                'Task not found',
                404
            );
        }

        return ApiResponse::success(
            new TaskResource($task),
            'Task Details'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return ApiResponse::error(
                'Task not found',
                404
            );
        }

        $task->update($request->validated());
        return ApiResponse::success(
            new TaskResource($task),
            'Task Updated successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return ApiResponse::error(
                'Task not found',
                404
            );
        }

        $task->delete();
        return ApiResponse::success(
            null,
            'Task deleted successfully'
        );
    }
}
