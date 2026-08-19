<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UpdateUserStatusRequest;
use App\Models\User;
use App\Models\Role;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    ) {
    }

    public function index(Request $request)
    {
        $users = $this->userService->getAll($request->input('q'));

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::orderBy('name')->get();

        return view('users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $this->userService->create(
            $request->validated()
        );

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        $user = $this->userService->findById(
            $user->id
        );

        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $user = $this->userService->findById(
            $user->id
        );

        $roles = Role::orderBy('name')->get();

        return view(
            'users.edit',
            compact('user', 'roles')
        );
    }

    public function update(
        UpdateUserRequest $request,
        User $user
    ) {
        $this->userService->update(
            $user,
            $request->validated()
        );

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $this->userService->deactivate($user);

        return redirect()
            ->route('users.index')
            ->with('success', 'User deactivated successfully.');
     
    }
    public function updateStatus(User $user)
    {

        $this->userService->updateStatus($user);

        return redirect()
            ->route('users.index')
            ->with('success', 'User activated successfully.');
     
    }
    
}