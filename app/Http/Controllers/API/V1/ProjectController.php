<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\PaginatedResource;
use App\Http\Resources\ProjectResource;
use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetProjectRequest $request)
    {
        $projects = Projects::search($request->search)
            ->latest()
            ->paginate($request->limit ?? 10);

        return ApiResponse::success(
            new PaginatedResource($projects, ProjectResource::class),
            'Projects List'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $project = Projects::create($request->validated());

        return ApiResponse::success(
            new ProjectResource($project),
            'Project Created Successfully',
            201,
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Projects::find($id);
        if (!$project) {
            return ApiResponse::error(
                'Project not found',
                404
            );
        }

        return ApiResponse::success(
            new ProjectResource($project),
            'Project Details'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, string $id)
    {
        $project = Projects::find($id);
        if (!$project) {
            return ApiResponse::error(
                'Project not found',
                404
            );
        }
        $project->update($request->validated());
        return ApiResponse::success(
            new ProjectResource($project),
            'Project Updated Successfully'
        );
    }

    public function destroy(string $id)
    {
        $project = Projects::find($id);
        if (!$project) {
            return ApiResponse::error(
                'Project not found',
                404
            );
        }
        $project->delete();
        return ApiResponse::success(
            null,
            'Project Deleted Successfully'
        );
    }
}
