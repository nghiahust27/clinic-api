<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePermission
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
      
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated.'
            ], 401);
        }

        $route = $request->route();

        $controller = $route->getController();

        if (!$controller) {
            return $next($request);
        }

       
        $controllerName = class_basename($controller);

        $controllerMap = [
            'UserController' => 'USERS',
            'RoleController' => 'ROLES',
            'SpecialtyController' => 'SPECIALTIES',
            'DoctorController' => 'DOCTORS',
            'PatientController' => 'PATIENTS',
            'AppointmentController' => 'APPOINTMENTS',
            'ExaminationController' => 'EXAMINATIONS',
            'MedicineController' => 'MEDICINES',
            'PrescriptionController' => 'PRESCRIPTIONS',
            'InvoiceController' => 'INVOICES',
            'PaymentController' => 'PAYMENTS',
            'StatsController' => 'STATS',
        ];

        if (!isset($controllerMap[$controllerName])) {
            return $next($request);
        }

        $resource = $controllerMap[$controllerName];

        $action = $route->getActionMethod();

        $actionMap = [
            'index' => 'FINDALL',
            'store' => 'CREATE',
            'show' => 'FINDONE',
            'update' => 'UPDATE',
            'destroy' => 'DELETE',
            'updateStatus' => 'UPDATESTATUS',
            'addItem' => 'ADDITEM',
            'updateItem' => 'UPDATEITEM',
            'removeItem' => 'REMOVEITEM',
            'capture' => 'CAPTURE',
            'adjustStock' => 'ADJUSTSTOCK',
        ];

        if (!isset($actionMap[$action])) {
            return $next($request);
        }
        $permissionName =
            $resource . '.' . $actionMap[$action];

        if (!$user->role) {
            return response()->json([
                'message' => 'User does not have a role.'
            ], 403);
        }

        $hasPermission = $user->role
            ->permissions()
            ->where('name', $permissionName)
            ->exists();

        if (!$hasPermission) {
            return response()->json([
                'message' => 'Forbidden.',
                'permission' => $permissionName,
            ], 403);
        }

        return $next($request);
    }
}