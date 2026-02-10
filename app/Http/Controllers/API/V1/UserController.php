<?php

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\GetUsersRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\PaginatedResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetUsersRequest $request)
    {
        $users = User::search($request->search)
            ->latest()
            ->paginate($request->limit ?? 10);

        return ApiResponse::success(
            new PaginatedResource($users, UserResource::class),
            'Users List',
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());

        return ApiResponse::success(
            new UserResource($user),
            'User Created Successfully',
            201,
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return ApiResponse::error(
                'User not found',
                404,
            );
        }

        return ApiResponse::success(
            new UserResource($user),
            'User Details'

        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return ApiResponse::error(
                'User not found',
                404,
            );
        }
        $user->update($request->validated());
        return ApiResponse::success(
            new UserResource($user),
            "User Updated successfully"
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return ApiResponse::error(
                'User not found',
                404,
            );
        }

        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }
        $user->delete();

        return ApiResponse::success(
            null,
            'User Deleted successfully',
        );
    }
}
