<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Examination;
use App\Models\Invoice;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\PrescriptionItem;
use App\Models\Role;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run(): void
    {

        // ROLES
        $doctorRole = Role::where('name', 'DOCTOR')->firstOrFail();
        $receptionistRole = Role::where('name', 'RECEPTIONIST')->firstOrFail();
        $cashierRole = Role::where('name', 'CASHIER')->firstOrFail();

        // USERS

        $doctorUser = User::updateOrCreate(
            ['email' => 'doctor.demo@clinic.test'],
            [
                'name' => 'Demo Doctor',
                'password' => Hash::make('password'),
                'role_id' => $doctorRole->id,
                'is_active' => true,
            ]
        );

        $receptionist = User::updateOrCreate(
            ['email' => 'receptionist.demo@clinic.test'],
            [
                'name' => 'Demo Receptionist',
                'password' => Hash::make('password'),
                'role_id' => $receptionistRole->id,
                'is_active' => true,
            ]
        );

        $cashier = User::updateOrCreate(
            ['email' => 'cashier.demo@clinic.test'],
            [
                'name' => 'Demo Cashier',
                'password' => Hash::make('password'),
                'role_id' => $cashierRole->id,
                'is_active' => true,
            ]
        );

        // SPECIALTY
        $specialty = Specialty::firstOrCreate([
            'name' => 'General Medicine',
        ]);

        // DOCTOR
        $doctor = Doctor::updateOrCreate(
            ['user_id' => $doctorUser->id],
            [
                'specialty_id' => $specialty->id,
                'license_number' => 'DR123'
            ]
        );

        //PATIENT
        $patient = Patient::updateOrCreate(
            ['phone' => '0912345678'],
            [
                'full_name' => 'Nguyen Minh Nghia',
                'code'=>'PT00001',
                'date_of_birth' => '2005-07-27',
                'gender' => 'male',
                'address' => 'Ha Noi',
            ]
        );

        //MEDICINES
        $paracetamol = Medicine::updateOrCreate(
            ['code' => 'PARA500'],
            [
                'name' => 'Paracetamol 500mg',
                'unit' => 'tablet',
                'price' => 2000,
                'stock' => 100,
                'is_active' => true,
            ]
        );

        $amoxicillin = Medicine::updateOrCreate(
            ['code' => 'AMOX500'],
            [
                'name' => 'Amoxicillin 500mg',
                'unit' => 'capsule',
                'price' => 3000,
                'stock' => 100,
                'is_active' => true,
            ]
        );

        //APPOINTMENT
        $appointment = Appointment::updateOrCreate(
            [
                'patient_id' => $patient->id,
                'doctor_id' => $doctor->id,
                'scheduled_at' => '2026-08-20 09:00:00',
            ],
            [
                'status' => 'completed',
                'reason' => 'Fever and headache',
            ]
        );

        //EXAMINATION
        $examination = Examination::updateOrCreate(
            [
                'appointment_id' => $appointment->id,
            ],
            [
                'diagnosis' => 'Common cold',
                'doctor_id' => $doctor->id,
                'patient_id' => $patient->id,
                'note' => 'Patient should rest and drink plenty of water.',
                'examination_fee' => 100000,
                'examinated_at' => '2026-08-20 09:30:00',
            ]
        );

        // PRESCRIPTION
        $prescription = Prescription::updateOrCreate(
            [
                'examination_id' => $examination->id,
            ],
            [
                'doctor_id' => $doctor->id,
                'note' => 'Take medicine after meals.',
            ]
        );

        //PRESCRIPTION ITEMS
        PrescriptionItem::updateOrCreate(
            [
                'prescription_id' => $prescription->id,
                'medicine_id' => $paracetamol->id,
            ],
            [
                'quantity' => 10,
                'dousage' => '1 tablet',
                'usage_instruction' => 'Take 2 times per day after meals.',
            ]
        );

        PrescriptionItem::updateOrCreate(
            [
                'prescription_id' => $prescription->id,
                'medicine_id' => $amoxicillin->id,
            ],
            [
                'quantity' => 10,
                'dousage' => '1 capsule',
                'usage_instruction' => 'Take 2 times per day after meals.',
            ]
        );

        // INVOICE
        $medicineTotal =
            (10 * $paracetamol->price) +
            (10 * $amoxicillin->price);

        $subtotal = $medicineTotal + $examination->examination_fee;

        $invoice = Invoice::updateOrCreate(
            [
                'examination_id' => $examination->id,
            ],
            [
                'invoice_code' => 'INV-DEMO-001',
                'subtotal' => $subtotal,
                'discount' => 0,
                'total' => $subtotal,
                'status' => 'unpaid',
                'issued_at' => '2026-08-20 10:00:00',
            ]
        );

        // OUTPUT

        $this->command->info('Demo data created successfully.');

        $this->command->info(
            "Doctor: {$doctorUser->email} / password"
        );

        $this->command->info(
            "Receptionist: {$receptionist->email} / password"
        );

        $this->command->info(
            "Cashier: {$cashier->email} / password"
        );

        $this->command->info(
            "Patient: {$patient->full_name}"
        );

        $this->command->info(
            "Appointment ID: {$appointment->id}"
        );

        $this->command->info(
            "Examination ID: {$examination->id}"
        );

        $this->command->info(
            "Prescription ID: {$prescription->id}"
        );

        $this->command->info(
            "Invoice: {$invoice->invoice_code}"
        );

        $this->command->info(
            "Invoice total: {$invoice->total}"
        );
    }
}