<?php

namespace App\Events;

use App\Models\PrescriptionItem;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PrescriptionItemUpdated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public PrescriptionItem $item,
        public int $oldQuantity,
        public int $newQuantity
    ) {}
}