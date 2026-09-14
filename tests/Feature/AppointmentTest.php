<?php

namespace Tests\Feature;

use App\Models\Appointment;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentTest extends TestCase
{
    use RefreshDatabase;

    private function receptionist(array $permissions = [])
    {
        $role = Role::create([
            'name' => 'RECEPTIONIST',
            'display_name' => 'Receptionist'
        ]);
        foreach($permissions as $permissionName)
        {
            $permission = Permission::create([
                'name' => $permissionName,
                'display_name'=> $permissionName
            ]);
            $role-> permissions()->attach($permission->id);
        }
        return User::factory()->create([
            'role_id' => $role->id
        ]);
    }
    public function test_receptionist_can_create_appointment()
    {
        $user = $this->receptionist([
            'APPOINTMENTS.CREATE'
        ]);
        $patient = Patient::factory()->create();
        $doctor = Doctor::factory()->create();

        $response = $this
            ->actingAs($user, 'sanctum')
            ->postJson('/api/appointments', [
                'patient_id' => $patient->id,
                'doctor_id' => $doctor->id,
                'scheduled_at' => now()
                    ->addDay()
                    ->setTime(9, 30)
                    ->format('Y-m-d H:i:s'),
                'reason' => 'Đau đầu',
            ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas(
            'appointments',[
                'patient_id'=>$patient->id,
                'doctor_id'=>$doctor->id,
                'status'=>'scheduled'
            ]
        );
    }
    public function test_user_without_permission_cannot_create_appointment()
    {
        $user = $this->receptionist([]);
        $patient = Patient::factory()->create();
        $doctor = Doctor::factory()->create();
        $response = $this
            ->actingAs($user,'sanctum')
            ->postJson('/api/appointments',[
                'patient_id'=>$patient->id,
                'doctor_id'=>$doctor->id,
                'scheduled_at'=>'2026-08-10 09:30:00'
            ]);
        $response->assertStatus(403);
    }

    public function test_cannot_create_duplicate_doctor_schedule()
    {
        $user = $this->receptionist([
            'APPOINTMENTS.CREATE'
        ]);

        $patient1 = Patient::factory()->create();
        $patient2 = Patient::factory()->create();
        $doctor = Doctor::factory()->create();

        Appointment::create([
            'patient_id'=>$patient1->id,
            'doctor_id'=>$doctor->id,
            'scheduled_at'=>'2026-08-10 09:30:00',
            'status'=>'scheduled'
        ]);
        $response = $this
            ->actingAs($user,'sanctum')
            ->postJson('/api/appointments',[
                'patient_id'=>$patient2->id,
                'doctor_id'=>$doctor->id,
                'scheduled_at'=>'2026-08-10 09:30:00'
            ]);

        $response->assertStatus(422);
    }

    public function test_can_list_appointments()
    {
        $user = $this->receptionist([
            'APPOINTMENTS.FINDALL'
        ]);

        Appointment::factory()->create();

        $response = $this
            ->actingAs($user,'sanctum')
            ->getJson('/api/appointments');
        $response
            ->assertStatus(200);

    }


    public function test_can_show_appointment()
    {
        $user = $this->receptionist([
            'APPOINTMENTS.FINDONE'
        ]);
        $appointment =
            Appointment::factory()->create();

        $response = $this->actingAs($user,'sanctum')
            ->getJson("/api/appointments/{$appointment->id}");

        $response->assertStatus(200);
    }
}