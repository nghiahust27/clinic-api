<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Users
            ['name' => 'USERS.FINDALL', 'display_name' => 'List users'],
            ['name' => 'USERS.CREATE', 'display_name' => 'Create user'],
            ['name' => 'USERS.FINDONE', 'display_name' => 'View user'],
            ['name' => 'USERS.UPDATE', 'display_name' => 'Update user'],
            ['name' => 'USERS.DELETE', 'display_name' => 'Deactivate user'],
            ['name' => 'USERS.UPDATESTATUS', 'display_name' => 'Update user status'],

            // Roles
            ['name' => 'ROLES.FINDALL', 'display_name' => 'List roles'],

            // Specialties
            ['name' => 'SPECIALTIES.FINDALL', 'display_name' => 'List specialties'],
            ['name' => 'SPECIALTIES.CREATE', 'display_name' => 'Create specialty'],
            ['name' => 'SPECIALTIES.FINDONE', 'display_name' => 'View specialty'],
            ['name' => 'SPECIALTIES.UPDATE', 'display_name' => 'Update specialty'],
            ['name' => 'SPECIALTIES.DELETE', 'display_name' => 'Delete specialty'],

            // Doctors
            ['name' => 'DOCTORS.FINDALL', 'display_name' => 'List doctors'],
            ['name' => 'DOCTORS.CREATE', 'display_name' => 'Create doctor'],
            ['name' => 'DOCTORS.FINDONE', 'display_name' => 'View doctor'],
            ['name' => 'DOCTORS.UPDATE', 'display_name' => 'Update doctor'],
            ['name' => 'DOCTORS.DELETE', 'display_name' => 'Delete doctor'],

            // Patients
            ['name' => 'PATIENTS.FINDALL', 'display_name' => 'List patients'],
            ['name' => 'PATIENTS.CREATE', 'display_name' => 'Create patient'],
            ['name' => 'PATIENTS.FINDONE', 'display_name' => 'View patient'],
            ['name' => 'PATIENTS.UPDATE', 'display_name' => 'Update patient'],
            ['name' => 'PATIENTS.DELETE', 'display_name' => 'Delete patient'],

            // Appointments
            ['name' => 'APPOINTMENTS.FINDALL', 'display_name' => 'List appointments'],
            ['name' => 'APPOINTMENTS.CREATE', 'display_name' => 'Create appointment'],
            ['name' => 'APPOINTMENTS.FINDONE', 'display_name' => 'View appointment'],
            ['name' => 'APPOINTMENTS.UPDATE', 'display_name' => 'Update appointment'],
            ['name' => 'APPOINTMENTS.UPDATESTATUS', 'display_name' => 'Update appointment status'],

            // Examinations
            ['name' => 'EXAMINATIONS.FINDALL', 'display_name' => 'List examinations'],
            ['name' => 'EXAMINATIONS.CREATE', 'display_name' => 'Create examination'],
            ['name' => 'EXAMINATIONS.FINDONE', 'display_name' => 'View examination'],
            ['name' => 'EXAMINATIONS.UPDATE', 'display_name' => 'Update examination'],

            // Medicines
            ['name' => 'MEDICINES.FINDALL', 'display_name' => 'List medicines'],
            ['name' => 'MEDICINES.CREATE', 'display_name' => 'Create medicine'],
            ['name' => 'MEDICINES.FINDONE', 'display_name' => 'View medicine'],
            ['name' => 'MEDICINES.UPDATE', 'display_name' => 'Update medicine'],
            ['name' => 'MEDICINES.DELETE', 'display_name' => 'Delete medicine'],
            ['name' => 'MEDICINES.ADJUSTSTOCK', 'display_name' => 'Adjust medicine stock'],

            // Prescriptions
            ['name' => 'PRESCRIPTIONS.FINDALL', 'display_name' => 'List prescriptions'],
            ['name' => 'PRESCRIPTIONS.CREATE', 'display_name' => 'Create prescription'],
            ['name' => 'PRESCRIPTIONS.FINDONE', 'display_name' => 'View prescription'],
            ['name' => 'PRESCRIPTIONS.UPDATE', 'display_name' => 'Update prescription'],
            ['name' => 'PRESCRIPTIONS.ADDITEM', 'display_name' => 'Add prescription item'],
            ['name' => 'PRESCRIPTIONS.UPDATEITEM', 'display_name' => 'Update prescription item'],
            ['name' => 'PRESCRIPTIONS.REMOVEITEM', 'display_name' => 'Remove prescription item'],

            // Invoices
            ['name' => 'INVOICES.FINDALL', 'display_name' => 'List invoices'],
            ['name' => 'INVOICES.CREATE', 'display_name' => 'Create invoice'],
            ['name' => 'INVOICES.FINDONE', 'display_name' => 'View invoice'],
            ['name' => 'INVOICES.UPDATE', 'display_name' => 'Update invoice'],
            ['name' => 'INVOICES.UPDATESTATUS', 'display_name' => 'Update invoice status'],

            // Payments
            ['name' => 'PAYMENTS.FINDALL', 'display_name' => 'List payments'],
            ['name' => 'PAYMENTS.CREATE', 'display_name' => 'Create payment'],
            ['name' => 'PAYMENTS.CAPTURE', 'display_name' => 'Capture payment'],

            // Stats
            ['name' => 'STATS.SHOW', 'display_name' => 'View statistics'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission['name']],
                ['display_name' => $permission['display_name']]
            );
        }
    }
}