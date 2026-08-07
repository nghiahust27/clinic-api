<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Permission;

class PatientTest extends TestCase
{

    use RefreshDatabase;

    private function receptionist(array $permissions = [])
    {
        $role = Role::create([
            'name' => 'RECEPTIONIST',
            'display_name' => 'Receptionist',
        ]);

        foreach ($permissions as $permissionName) {

            $permission = Permission::create([
                'name' => $permissionName,
                'display_name' => $permissionName,
            ]);

            $role->permissions()->attach($permission->id);
        }

        return User::factory()->create([
            'role_id' => $role->id
        ]);
    }


    public function test_receptionist_can_create_patient()
    {
        $user = $this->receptionist(['PATIENTS.CREATE']);
        
        $response = $this->actingAs($user,'sanctum')
            ->postJson('/api/patients',[
                'full_name'=>'Nguyen Van A',
                'gender'=>'male',
                'date_of_birth'=>'2000-01-01',
                'phone'=>'0912345678'
            ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas(
            'patients', ['phone'=>'0912345678']
        );
    }


    public function test_patient_search_by_phone()
    {
        Patient::factory()->create(['phone'=>'0912345678']);
        $user = $this->receptionist(['PATIENTS.FINDALL' ]);

        $response = $this
            ->actingAs($user,'sanctum')
            ->getJson('/api/patients?q=0912345678');

        $response
            ->assertStatus(200)
            ->assertJsonFragment(['phone'=>'0912345678']);
    }

}