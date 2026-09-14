<?php

namespace App\Listeners;

use App\Events\PaymentSucceeded;
use App\Mail\PaymentSuccessMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPaymentSuccessEmail implements ShouldQueue
{
    
    public function handle(PaymentSucceeded $event): void
    {   
        $payment = $event->payment->load([
            'invoice.examination.appointment.patient'
        ]);
        $patient =  $payment->invoice->examination->appointment->patient;

        if(!$patient?->email)
            {
                return;
            }
        Mail::to($patient->email)
        ->send(new PaymentSuccessMail($payment));
    }
}
