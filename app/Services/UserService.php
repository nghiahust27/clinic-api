<?php

namespace App\Services;

use App\Events\UserActivityLogged;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService
{
    private const MESSAGE = 'Cannot modify or deactivate the last active ADMIN.';

    private function ensureNotLastActiveAdmin(): void
    {
        $activeAdminCount = User::where('is_active', true)
            ->whereHas('role', function ($query) {
                $query->where('name', Role:: ADMIN);
            })
            ->count();

        if ($activeAdminCount <= 1) {
            throw ValidationException::withMessages([
                'user' => [
                    self::MESSAGE
            ]]);
        }
    }
    public function getAll( ?string $search = null)
    {
        $query = User::with('role');
        if($search)
            {
                $query->where(function ($q)use($search) {
                    $q -> where('name', 'ILIKE', "%{$search}%")
                    ->orWhere('email', 'ILIKE', "%{$search}%");
                });
            } 
        return $query
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function findById(int $id): User 
    {
        return User::with('role')->findOrFail($id);
    }

    public function create(array $data): User
    {
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        event(new UserActivityLogged($user,'user.created',
            [
                'email' => $user->email,
                'role_id' => $user->role_id,
            ]
        ));
        return $user->load('role');
    }

    public function update(User $user, array $data): User
    {
        if (
            isset($data['role_id']) &&
            $data['role_id'] != $user->role_id &&
            $user->role?->name === 'ADMIN'
        ) {
            $this->ensureNotLastActiveAdmin();
        }

        $user->update($data);

        event(new UserActivityLogged($user,'user.updated',
            [
                'email' => $user->email,
                'role_id' => $user->role_id,
            ]
        ));

        return $user->fresh('role');
    }

    public function deactivate(User $user): User
    {
        if ($user->role?->name === 'ADMIN') {
            $this->ensureNotLastActiveAdmin();
        }

        $user->update([
            'is_active' => false,
        ]);
        event(new UserActivityLogged($user,'user.deactivated',
            [
                'email' => $user->email,
            ]
        ));

        return $user->fresh('role');
    }
    public function activate(User $user): User
    {
        if ($user->role?->name === 'ADMIN') {
            $this->ensureNotLastActiveAdmin();
        }

        $user->update([
            'is_active' => true,
        ]);
        event(new UserActivityLogged($user,'user.activated',
            [
                'email' => $user->email,
            ]
        ));

        return $user->fresh('role');
    }

    public function updateStatus(User $user, bool $isActive): User
    {
        if (!$isActive &&$user->role?->name === 'ADMIN') 
        {
            $this->ensureNotLastActiveAdmin();
        }

        $user->update([
            'is_active' => $isActive,
        ]);

        return $user->fresh('role');
    }

    
}