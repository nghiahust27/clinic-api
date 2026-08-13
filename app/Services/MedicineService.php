<?php

namespace App\Services;

use App\Http\Requests\Medicine\StoreMedicineRequest;
use App\Models\Medicine;
use Illuminate\Validation\ValidationException;

class MedicineService
{
    

    public function getAll(?string $q= null)
    {
        return Medicine::query()->when($q, function($query) use ($q){
            $query->where(function ($sub) use($q) {
                $sub->where('name', 'LIKE', "%$q%")
                ->orWhere('code', 'LIKE', "%$q%");
            });
        })->latest()->paginate(10);
    }

    public function create(array $data)
    {
        return Medicine::create($data);
    }
    public function update(Medicine $medicine, array $data)
    {
        $medicine->update($data);
        return $medicine->fresh();
    }
    public function delete(Medicine $medicine)
    {
        $medicine->delete();
    }

    public function adjustStock(Medicine $medicine, array $data)
    {
        $newStock = $medicine->stock + $data['quantity'];

        if($newStock < 0)
        {
            throw ValidationException::withMessages([
                'quantity' => 'Not enough medicine in stock'
            ]);
        }
        $medicine->update(['stock' => $newStock]);
        return $medicine;
    }

    public function deactivate(Medicine $medicine)
    {
        $medicine->update(['is_active'=>false]);
        return $medicine->fresh();
    }

    public function activate(Medicine $medicine)
    {
        $medicine->update(['is_active'=>true]);
        return $medicine->fresh();
    }

}