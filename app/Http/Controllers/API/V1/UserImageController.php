<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadUserImageRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Storage;

class UserImageController extends Controller
{
    public function store(UploadUserImageRequest $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            ApiResponse::error(
                'User not found',
                404
            );
        }

        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }
        $path = $request->file('photo')->store('user-images', 'public');
        $user->update(['photo' => $path]);
        return ApiResponse::success(
            new UserResource($user),
            'User photo uploaded successfully',
            201
        );
    }
}
