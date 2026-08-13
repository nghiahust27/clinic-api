<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    public const ADMIN ='ADMIN';
    public const RECEPTIONIST ='RECEPTIONIST';
    public const DOCTOR ='DOCTOR';
    public const PHARMACIST ='PHARMACIST';
    public const CASHIER ='CASHIER';


    protected $fillable = ['name', 'display_name'];
    public function users() : HasMany {
        return $this->hasMany(User::class);        
    }

    public function permissions() : BelongsToMany {
        return $this->belongsToMany(Permission::class, 
        'role_permissions', 'role_id','permission_id');
    }
}
