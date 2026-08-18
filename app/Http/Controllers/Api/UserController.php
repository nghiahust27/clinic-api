<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UpdateUserStatusRequest;
use App\Http\Resources\UserResource;
use App\Http\Traits\ApiResponse;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponse;

    public function __construct(
        private UserService $userService
    ) {
    }

    public function index()
    {
        $users = UserResource::collection(
            $this->userService->getAll()
        );

        return $this->paginatedResponse(
            $users,
            'Users retrieved successfully.'
        );
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->create(
            $request->validated()
        );

        return $this->successResponse(
            new UserResource($user),
            'User created successfully.',
            201
        );
    }

    public function show(User $user)
    {
        $user = $this->userService->findById(
            $user->id
        );

        return $this->successResponse(
            new UserResource($user),
            'User retrieved successfully.'
        );
    }

    public function update(
        UpdateUserRequest $request,
        User $user
    ) {
        $user = $this->userService->update(
            $user,
            $request->validated()
        );

        return $this->successResponse(
            new UserResource($user),
            'User updated successfully.'
        );
    }

    public function destroy(User $user)
    {
        $user = $this->userService->deactivate($user);

        return $this->successResponse(
            new UserResource($user),
            'User deactivated successfully.'
        );
    }

    public function updateStatus(
        UpdateUserStatusRequest $request,
        User $user
    ) {
        $user = $this->userService->updateStatus(
            $user,
            $request->boolean('is_active')
        );

        return $this->successResponse(
            new UserResource($user),
            'User status updated successfully.'
        );
    }
}