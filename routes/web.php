<?php

use App\Http\Controllers\Web\AppointmentController;
use App\Http\Controllers\Web\DoctorController;
use App\Http\Controllers\Web\ExaminationController;
use App\Http\Controllers\Web\MedicineController;
use App\Http\Controllers\Web\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\InvoiceController;
use App\Http\Controllers\Web\PaymentController;
use App\Http\Controllers\Web\PrescriptionController;
use App\Models\Invoice;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
});


Route::middleware(['auth','permission'])->group(function(){
    //PATIENTS
    Route::resource('patients', PatientController::class);
    Route::get('/patients/trash', [PatientController::class, 'trash'])
    ->name('patients.trash');
    Route::get(
        '/patients/{patient}/appointments/create',
        [AppointmentController::class, 'create']
    )->name('patients.appointments.create');

    Route::post(
    '/patients/{patient}/create-appointment',
    [AppointmentController::class, 'store']
    )->name('patients.create-appointment');

    //APPOINTMENTS
    Route::resource('appointments', AppointmentController::class);

    Route::patch('/appointments/{appointment}/status', 
    [AppointmentController::class, 'updateStatus'])
    ->name('appointments.updateStatus');

    Route::get('/appointments/{appointment}/examinations/create',
        [ExaminationController::class, 'create']
    )->name('appointments.examinations.create');

    Route::post('/appointments/{appointment}/create-examination',
    [ExaminationController::class, 'store']
    )->name('appointments.create-examination');



    Route::resource('doctors', DoctorController::class);

    Route::resource('examinations', ExaminationController::class);

    // MEDICINES
    Route::resource('medicines', MedicineController::class);
    Route::get('/medicines/{medicine}/adjust-stock', 
    [MedicineController::class, 'adjustStockForm'])
    ->name('medicines.adjust-stock');
    Route::patch(
        '/medicines/{medicine}/adjust-stock',
        [MedicineController::class, 'adjustStock']
    )->name('medicines.adjust-stock.update');
    Route::resource('medicines', MedicineController::class);
    Route::patch('/medicines/{medicine}/activate',[MedicineController::class, 
    'activate'])->name('medicines.activate');
    Route::patch('/medicines/{medicine}/deactivate',[MedicineController::class, 
    'deactivate'])->name('medicines.deactivate');

    //...USER...
    Route::resource('users', UserController::class);
    Route::patch('/users/{user}/status',[UserController::class, 
    'updateStatus'])->name('users.updateStatus');
    Route::patch('/users/{user}/activate',[UserController::class, 
    'activate'])->name('users.activate');

    //...PRESCRIPTION
    Route::resource('prescriptions', PrescriptionController::class);

    Route::get(
    '/examinations/{examination}/prescriptions/create',
        [PrescriptionController::class, 'create']
    )->name('examinations.prescriptions.create');

    Route::put(
    '/prescriptions/{prescription}/items/{item}',
    [PrescriptionController::class, 'updateItem']
    )->name('prescriptions.items.update');

    Route::post(
        '/prescriptions/{prescription}/items',
        [PrescriptionController::class, 'addItem']
    )->name('prescriptions.items.store');

    Route::delete(
        '/prescriptions/{prescription}/items/{item}',
        [PrescriptionController::class, 'removeItem']
    )->name('prescriptions.items.destroy');
    Route::put(
    '/prescriptions/{prescription}',
        [PrescriptionController::class, 'update']
    )->name('prescriptions.update');

    //...INVOICE
    Route::resource('/invoices', InvoiceController::class);
     Route::get(
    '/examinations/{examination}/invoices/create',
        [InvoiceController::class, 'create']
    )->name('examinations.invoices.create');
    
     Route::patch('/invoices/{invoice}/status', 
    [InvoiceController::class, 'updateStatus'])
    ->name('invoices.updateStatus');
    
    //...PAYMENT

    Route::get('/payments', [PaymentController::class, 'index'])
    ->name('payments.index');
    Route::get('invoices/{invoice}/payments/create', 
    [PaymentController::class, 'create'])->name('payments.create');
    Route::post('invoices/{invoice}/payments', 
    [PaymentController::class, 'store'])->name('payments.store');


    Route::get('payments/{payment}/card', 
    [PaymentController::class, 'showCardForm'])->name('payments.card');


    Route::get('payments/paypal/success', 
    [PaymentController::class, 'paypalSuccess'])->name('payments.paypal.success');
    Route::get('payments/paypal/cancel', 
    [PaymentController::class, 'paypalCancel'])->name('payments.paypal.cancel');
    
});

require __DIR__.'/auth.php';
