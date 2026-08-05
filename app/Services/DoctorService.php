<?php

namespace App\Services;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class DoctorService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {}
    public function getAll(int $perPage = 5)
    {
        return Doctor::with('user', 'specialty')
            ->latest()
            ->paginate($perPage);
    }
    public function findById(int $id)
    {
        return Doctor::with(['user', 'specialty'])
        ->findOrFail($id);
    }   
    public function create(array $data): Doctor
    {
        $user = User::with('role')->findOrFail($data['user_id']);
        if(!$user->role || $user->role->name !== 'DOCTOR')
        {
            throw ValidationException::withMessages([
                'user_id'=>['The selected user must have a DOCTOR role']
            ]);
        }
        if($user->doctor()->exists())
        {
            throw ValidationException::withMessages([
                'user_id'=> 'This user already has a doctor profile'
            ]);
        }
        $doctor = Doctor::create($data);
        return $doctor ->fresh(['user', 'specialty']);
    }
    public function update(Doctor $doctor, array $data)
    {
        if(isset($data['user_id']))
        {
            $user = User::with('role')->findOrFail($data['user_id']);

            if(!$user->role || $user->role->name !=="DOCTOR")
            {
                throw ValidationException::withMessages([
                    'user_id'=>'The selected user must have the DOCTOR role'
                ]);
            }
            $existingDoctor = Doctor::where('user_id', $data['user_id'])
            ->where('id', '!=', $doctor->id)->exists();

            if($existingDoctor)
            {
                throw ValidationException::withMessages([
                    'user_id'=>'This user already has a doctor profile'
                ]);
            }
        }

        $doctor -> update($data);
        return $doctor->fresh(['user', 'spectialty']);
    }

    public function delete(Doctor $doctor)
    {
        $doctor->delete();
    }
}
