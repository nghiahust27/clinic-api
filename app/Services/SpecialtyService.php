<?php

namespace App\Services;

use App\Http\Requests\Specialty\StoreSpecialtyRequest;
use App\Models\Specialty;
use PhpParser\Node\Expr\FuncCall;

class SpecialtyService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }
    public function getAll(int $perPage = 5)
    {
        return Specialty::latest()->paginate($perPage);
    }
    public function findById(int $id)
    {
        return Specialty::findOrFail($id);
    }
    public function create(array $data)
    {
        return Specialty::create($data);
    }
    public function update(Specialty $specialty, array $data)
    {
        $specialty->update($data);
        return $specialty->fresh();
    }
    public function delete(Specialty $specialty)
    {
        $specialty->delete();
    }
}
