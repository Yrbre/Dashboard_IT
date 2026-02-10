<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetDepartmentRequest;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Http\Resources\PaginatedResource;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetDepartmentRequest $request)
    {
        $department = Department::search($request->search)
            ->latest()
            ->paginate($request->limit ?? 10);

        return ApiResponse::success(
            new PaginatedResource($department, DepartmentResource::class),
            'Departments List'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request)
    {
        $department = Department::create($request->validated());

        return ApiResponse::success(
            new DepartmentResource($department),
            'Department created successfully',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::find($id);
        if (!$department) {
            return ApiResponse::error(
                'Department not found',
                404
            );
        }

        return ApiResponse::success(
            new DepartmentResource($department),
            'Department details'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, string $id)
    {
        $department = Department::find($id);
        if (!$department) {
            return ApiResponse::error(
                'Department not found',
                404
            );
        }

        $department->update($request->validated());
        return ApiResponse::success(
            new DepartmentResource($department),
            'Department updated successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::find($id);
        if (!$department) {
            return ApiResponse::error(
                'Department not found',
                404
            );
        }

        $department->delete();
        return ApiResponse::success(
            null,
            'Department deleted successfully'
        );
    }
}
