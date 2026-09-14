<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePermission
{
    public function handle(Request $request, Closure $next): Response 
    {
      
        if ($request->is('payments/paypal/*')) {
            return $next($request);
        }

        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
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
        $method   = $route->getActionMethod();

        $actionMap = [
            'index' => 'FINDALL',
            'create' => 'CREATE',
            'store' => 'CREATE',
            'show' => 'FINDONE',
            'edit' => 'UPDATE',
            'update' => 'UPDATE',
            'destroy'  => 'DELETE',
            'showCardForm' => 'CREATE',
            'updateStatus' => 'UPDATESTATUS',
            'addItem'=> 'ADDITEM',
            'updateItem' => 'UPDATEITEM',
            'removeItem' => 'REMOVEITEM',
            'capture' => 'CAPTURE',
            'adjustStock' => 'ADJUSTSTOCK',
            'adjustStockForm'    => 'ADJUSTSTOCK',
        ];

        if ($controllerName === 'StatsController' && $method === 'index') {
            $action = 'SHOW';
        } else {
            $action = $actionMap[$method] ?? strtoupper($method);
        }

        $permissionName = $resource . '.' . $action;

        if (!$user->role) {
            return response()->json(['message' 
            => 'User does not have a role.'], 403);
        }

        $hasPermission = $user->role
            ->permissions()
            ->where('name', $permissionName)
            ->exists();

        if (!$hasPermission) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message'    => 'Forbidden.',
                    'permission' => $permissionName,
                ], 403);
            }
            abort(403);
        }

        return $next($request);
    }
}