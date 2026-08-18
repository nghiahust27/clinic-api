<?php

namespace App\Events;

use App\Models\Examination;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExaminationUpdated
{
     use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
         public Examination $examination,
         public string $oldDiagnosis,
         public string $newDiagnosis,
         public string $oldNote,
         public string $newNote,


    )
    {
    
    }
}
