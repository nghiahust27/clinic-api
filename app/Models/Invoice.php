<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Override;

class Invoice extends Model
{
    protected $fillable = ['examination_id','invoice_code',
    'subtotal','discount','total','status','issued_at'];

    protected $casts = [
        'subtotal' =>'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
        'issued_at' => 'datetime'
    ];

    public function examination()
    {
        return $this->belongsTo(Examination::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
   
    public function getPaidAmountAttribute(): float
    {
        return (float) $this->payments->where('status', 'completed')->sum('amount');
    }
    public function getRemainingAmountAttribute(): float
    {
        $paid = $this->getPaidAmountAttribute();
        return max(0, $this->total - $paid);
    }
}
