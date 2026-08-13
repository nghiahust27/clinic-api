<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Models\Appointment;
use App\Models\Medicine;
use App\Models\Patient;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data = [];
        if($user->hasPermission('PATIENTS.FINDALL'))
        {
            $data['patientCount'] = Patient::count();
        }
        if($user->hasPermission('APPOINTMENTS.FINDALL'))
        {
            $data['appointmentCount'] = Appointment::whereDate(
                'scheduled_at', today()
            )->count();
            
            $data['appointments'] = Appointment::with('patient')
            ->whereDate('scheduled_at', today())
            ->orderBy('scheduled_at')
            ->limit(6)
            ->get();
        }

        if($user->hasPermission('MEDICINES.FINDALL'))
        {
            $data['medicineCount'] = Medicine::where('is_active', true)
            ->count();
        }
        return view('dashboard.index', $data);

    }
}
