<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RbacAndBusinessFlowTest extends TestCase
{
    use RefreshDatabase;


    public function receptionist_cannot_create_invoice()
    {
        $receptionistRole = Role::create(['name' => 'RECEPTIONIST']);
        $user = User::factory()->create(['role_id' => $receptionistRole->id]);

        $response = $this->actingAs($user)->postJson('/invoices', [
            'patient_id' => 1,
            'amount' => 500,
        ]);

        $response->assertStatus(403);
    }


    public function doctor_cannot_capture_payment()
    {
        $doctorRole = Role::create(['name' => 'DOCTOR']);
        $user = User::factory()->create(['role_id' => $doctorRole->id]);

        $response = $this->actingAs($user)->postJson('/payments/1/capture');

        $response->assertStatus(403);
    }


    public function full_medical_flow_patient_to_appointment_to_examination()
    {

        $admin = User::factory()->create(/* assign full permissions */);

        // Step 1: Create Patient
        $patientResp = $this->actingAs($admin)->post('/patients', [
            'name' => 'John Doe',
            'phone' => '0901234567',
        ]);
        $this->assertDatabaseHas('patients', ['name' => 'John Doe']);
        $patient = Patient::where('phone', '0901234567')->first();

        // Step 2: Create Appointment
        $appointmentResp = $this->actingAs($admin)->post('/appointments', [
            'patient_id' => $patient->id,
            'appointment_date' => now()->addDay()->toDateTimeString(),
        ]);
        $this->assertDatabaseHas('appointments', ['patient_id' => $patient->id]);
        $appointment = Appointment::where('patient_id', $patient->id)->first();

        // Step 3: Create Examination
        $examResp = $this->actingAs($admin)->post('/examinations', [
            'appointment_id' => $appointment->id,
            'diagnosis' => 'Flu',
        ]);
        $this->assertDatabaseHas('examinations', ['appointment_id' => $appointment->id]);
    }
}