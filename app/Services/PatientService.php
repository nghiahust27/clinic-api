<?php

namespace App\Services;

use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class PatientService
{
    public function getAll(?string $q=null)
    {
        return Patient::query()->when($q, function($query) use ($q){
            $query->where(function ($sub) use($q) {
                $sub->where('full_name', 'LIKE', "%$q%")
                ->orWhere('phone', 'LIKE', "%$q%")
                ->orWhere('code', 'LIKE', "%$q%");
                
            });
        })->latest()->paginate(5);
    }
     public function findById(int $id): Patient 
    {
        return Patient::findOrFail($id);
    }
    public function generateCode():string{
        $lastPatient = Patient::withTrashed()
        ->latest('id')->first();
        if(!$lastPatient)
        {
            return 'BN000001';
        }
        $lastNumber = intval(substr($lastPatient->code, 2));

        return 'BN' . str_pad($lastNumber + 1, 6,'0',STR_PAD_LEFT);
    }

    public function create(array $data)
    {
        return DB::transaction(function () use($data){
            $data['code'] = $this->generateCode();
            return Patient::create($data);
        });
        
    }
    public function update(Patient $patient, array $data)
    {
        return DB::transaction(function () use($patient ,$data){
            unset($data['code']);
            $patient->update($data);
            return $patient;
        });
        
    }
    public function delete(Patient $patient)
    {
        return $patient->delete();
    }
    public function getTrashed()
    {
        return Patient::onlyTrashed()->latest('deleted_at')
        ->paginate(5);
    }
}