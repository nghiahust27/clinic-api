<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Examination;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClinicWorkflowTest extends TestCase
{
    use RefreshDatabase;

    private function createRole(
        string $name,
        string $displayName
    ): Role {
        return Role::firstOrCreate(
            ['name' => $name],
            ['display_name' => $displayName]
        );
    }

    private function createPermission(string $name): Permission
    {
        return Permission::firstOrCreate(
            ['name' => $name],
            ['display_name' => $name]
        );
    }

    private function createUserWithRole(
        string $roleName,
        array $permissions = []
    ): User {
        $role = $this->createRole(
            $roleName,
            ucfirst(strtolower($roleName))
        );

        foreach ($permissions as $permissionName) {
            $permission = $this->createPermission($permissionName);

            $role->permissions()->syncWithoutDetaching([
                $permission->id,
            ]);
        }

        return User::factory()->create([
            'role_id' => $role->id,
        ]);
    }

    public function test_user_without_permission_gets_403(): void
    {
        $user = $this->createUserWithRole('RECEPTIONIST');

        $response = $this
            ->actingAs($user, 'sanctum')
            ->getJson('/api/stats');

        $response->assertStatus(403);

        $response->assertJson([
            'message' => 'Forbidden.',
            'permission' => 'STATS.FINDONE',
        ]);
    }

    public function test_receptionist_cannot_create_invoice(): void
    {
        $user = $this->createUserWithRole('RECEPTIONIST');

        $response = $this
            ->actingAs($user)
            ->post('/invoices', []);

        $response->assertStatus(403);
    }

    public function test_doctor_cannot_capture_payment(): void
    {
        $doctorUser = $this->createUserWithRole('DOCTOR');

        $doctor = Doctor::factory()->create([
            'user_id' => $doctorUser->id,
        ]);

        $patient = Patient::factory()->create();

        $appointment = Appointment::factory()->create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
        ]);

        $examination = Examination::create([
            'appointment_id' => $appointment->id,
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
            'diagnosis' => 'Test diagnosis',
            'note' => 'RBAC test examination',
            'examinated_at' => now(),
        ]);

        $invoice = Invoice::create([
            'examination_id' => $examination->id,
            'invoice_code' => 'INV-TEST-' . uniqid(),
            'subtotal' => 100000,
            'discount' => 0,
            'total' => 100000,
            'status' => 'unpaid',
            'issued_at' => now(),
        ]);

        $payment = Payment::create([
            'invoice_id' => $invoice->id,
            'amount' => 100000,
            'method' => 'paypal',
            'status' => 'pending',
            'provider' => 'paypal',
            'provider_order_id' => 'TEST-' . uniqid(),
            'provider_capture_id' => null,
            'paid_at' => null,
            'note' => 'RBAC test payment',
        ]);

        $response = $this
            ->actingAs($doctorUser, 'sanctum')
            ->postJson(
                "/api/payments/{$payment->id}/capture"
            );

        $response->assertStatus(403);

        $response->assertJson([
            'message' => 'Forbidden.',
            'permission' => 'PAYMENTS.CAPTURE',
        ]);
    }

    public function test_patient_appointment_examination_workflow_works(): void
    {
        $user = $this->createUserWithRole(
            'RECEPTIONIST',
            [
                'PATIENTS.CREATE',
                'APPOINTMENTS.CREATE',
                'APPOINTMENTS.UPDATESTATUS',
                'EXAMINATIONS.CREATE',
            ]
        );

        /*
        * 1. Create patient
        */
        $patientResponse = $this
            ->actingAs($user, 'sanctum')
            ->postJson('/api/patients', [
                'full_name' => 'Test Patient',
                'phone' => '0900000001',
                'email' => 'patient@test.com',
                'date_of_birth' => '2000-01-01',
                'gender' => 'male',
                'address' => 'Hanoi',
            ]);

        $patientResponse->assertSuccessful();

        $patientId = $patientResponse->json('data.id');

        $this->assertNotNull($patientId);

        $this->assertDatabaseHas('patients', [
            'id' => $patientId,
            'full_name' => 'Test Patient',
            'phone' => '0900000001',
        ]);

        /*
        * 2. Create doctor
        */
        $doctorRole = $this->createRole(
            'DOCTOR',
            'Doctor'
        );

        $doctorUser = User::factory()->create([
            'role_id' => $doctorRole->id,
        ]);

        $doctor = Doctor::factory()->create([
            'user_id' => $doctorUser->id,
        ]);

        /*
        * 3. Create appointment
        */
        $appointmentResponse = $this
            ->actingAs($user, 'sanctum')
            ->postJson('/api/appointments', [
                'patient_id' => $patientId,
                'doctor_id' => $doctor->id,
                'scheduled_at' => now()
                    ->addDay()
                    ->setTime(9, 0)
                    ->format('Y-m-d H:i:s'),
                'reason' => 'General examination',
            ]);

        $appointmentResponse->assertSuccessful();

        $appointmentId = $appointmentResponse->json('data.id');

        $this->assertNotNull($appointmentId);

        /*
        * 4. Confirm appointment
        */
        $confirmResponse = $this
            ->actingAs($user, 'sanctum')
            ->patchJson("/api/appointments/{$appointmentId}/status", [
                'status' => 'confirmed',
            ]);

        $confirmResponse->assertSuccessful();

        $this->assertDatabaseHas('appointments', [
            'id' => $appointmentId,
            'patient_id' => $patientId,
            'doctor_id' => $doctor->id,
            'status' => 'confirmed',
        ]);

        /*
        * 5. Create examination
        */
        $examinationResponse = $this
            ->actingAs($user, 'sanctum')
            ->postJson('/api/examinations', [
                'appointment_id' => $appointmentId,
                'doctor_id' => $doctor->id,
                'diagnosis' => 'Common cold',
                'note' => 'Patient should rest.',
                'examination_fee' => 100000,
            ]);

        $examinationResponse->assertSuccessful();

        $examinationId = $examinationResponse->json('data.id');

        $this->assertNotNull($examinationId);

        $this->assertDatabaseHas('examinations', [
            'id' => $examinationId,
            'appointment_id' => $appointmentId,
            'doctor_id' => $doctor->id,
            'diagnosis' => 'Common cold',
        ]);
    }
}