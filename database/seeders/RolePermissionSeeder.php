<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = Permission::pluck('id', 'name');

        $rolePermissions = [
            'ADMIN' => [
                // Users
                'USERS.FINDALL',
                'USERS.CREATE',
                'USERS.FINDONE',
                'USERS.UPDATE',
                'USERS.DELETE',
                'USERS.UPDATESTATUS',

                // Roles
                'ROLES.FINDALL',

                // Specialties
                'SPECIALTIES.FINDALL',
                'SPECIALTIES.CREATE',
                'SPECIALTIES.FINDONE',
                'SPECIALTIES.UPDATE',
                'SPECIALTIES.DELETE',

                // Doctors
                'DOCTORS.FINDALL',
                'DOCTORS.CREATE',
                'DOCTORS.FINDONE',
                'DOCTORS.UPDATE',
                'DOCTORS.DELETE',

                // Patients
                'PATIENTS.FINDALL',
                'PATIENTS.CREATE',
                'PATIENTS.FINDONE',
                'PATIENTS.UPDATE',
                'PATIENTS.DELETE',

                // Appointments
                'APPOINTMENTS.FINDALL',
                'APPOINTMENTS.CREATE',
                'APPOINTMENTS.FINDONE',
                'APPOINTMENTS.UPDATE',
                'APPOINTMENTS.UPDATESTATUS',

                // Examinations
                'EXAMINATIONS.FINDALL',
                'EXAMINATIONS.CREATE',
                'EXAMINATIONS.FINDONE',
                'EXAMINATIONS.UPDATE',

                // Medicines
                'MEDICINES.FINDALL',
                'MEDICINES.CREATE',
                'MEDICINES.FINDONE',
                'MEDICINES.UPDATE',
                'MEDICINES.DELETE',
                'MEDICINES.ADJUSTSTOCK',

                // Prescriptions
                'PRESCRIPTIONS.FINDALL',
                'PRESCRIPTIONS.CREATE',
                'PRESCRIPTIONS.FINDONE',
                'PRESCRIPTIONS.UPDATE',
                'PRESCRIPTIONS.ADDITEM',
                'PRESCRIPTIONS.UPDATEITEM',
                'PRESCRIPTIONS.REMOVEITEM',

                // Invoices
                'INVOICES.FINDALL',
                'INVOICES.CREATE',
                'INVOICES.FINDONE',
                'INVOICES.UPDATE',
                'INVOICES.UPDATESTATUS',

                // Payments
                'PAYMENTS.FINDALL',
                'PAYMENTS.CREATE',
                'PAYMENTS.CAPTURE',

                // Stats
                'STATS.SHOW',
            ],

            'RECEPTIONIST' => [
                'SPECIALTIES.FINDALL',
                'SPECIALTIES.FINDONE',

                'DOCTORS.FINDALL',
                'DOCTORS.FINDONE',

                'PATIENTS.FINDALL',
                'PATIENTS.CREATE',
                'PATIENTS.FINDONE',
                'PATIENTS.UPDATE',

                'APPOINTMENTS.FINDALL',
                'APPOINTMENTS.CREATE',
                'APPOINTMENTS.FINDONE',
                'APPOINTMENTS.UPDATE',
                'APPOINTMENTS.UPDATESTATUS',
            ],

            'DOCTOR' => [
                'SPECIALTIES.FINDALL',
                'SPECIALTIES.FINDONE',

                'DOCTORS.FINDALL',
                'DOCTORS.FINDONE',

                'PATIENTS.FINDALL',
                'PATIENTS.FINDONE',

                'APPOINTMENTS.FINDALL',
                'APPOINTMENTS.FINDONE',

                'EXAMINATIONS.FINDALL',
                'EXAMINATIONS.CREATE',
                'EXAMINATIONS.FINDONE',
                'EXAMINATIONS.UPDATE',

                'MEDICINES.FINDALL',
                'MEDICINES.FINDONE',

                'PRESCRIPTIONS.FINDALL',
                'PRESCRIPTIONS.CREATE',
                'PRESCRIPTIONS.FINDONE',
                'PRESCRIPTIONS.UPDATE',
                'PRESCRIPTIONS.ADDITEM',
                'PRESCRIPTIONS.UPDATEITEM',
                'PRESCRIPTIONS.REMOVEITEM',
            ],

            'PHARMACIST' => [
                'MEDICINES.FINDALL',
                'MEDICINES.CREATE',
                'MEDICINES.FINDONE',
                'MEDICINES.UPDATE',
                'MEDICINES.DELETE',
                'MEDICINES.ADJUSTSTOCK',

                'PRESCRIPTIONS.FINDALL',
                'PRESCRIPTIONS.FINDONE',
            ],

            'CASHIER' => [
                'PATIENTS.FINDALL',
                'PATIENTS.FINDONE',

                'APPOINTMENTS.FINDALL',
                'APPOINTMENTS.FINDONE',

                'EXAMINATIONS.FINDALL',
                'EXAMINATIONS.FINDONE',

                'INVOICES.FINDALL',
                'INVOICES.CREATE',
                'INVOICES.FINDONE',
                'INVOICES.UPDATE',
                'INVOICES.UPDATESTATUS',

                'PAYMENTS.FINDALL',
                'PAYMENTS.CREATE',
                'PAYMENTS.CAPTURE',
            ],
        ];

        foreach ($rolePermissions as $roleName => $permissionNames) {
            $role = Role::where('name', $roleName)->firstOrFail();

            foreach ($permissionNames as $permissionName) {
                $permissionId = $permissions[$permissionName];

                $role->permissions()->syncWithoutDetaching([
                    $permissionId,
                ]);
            }
        }
    }
}