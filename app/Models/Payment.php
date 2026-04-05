<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'commande_id',
        'provider',
        'provider_order_id',
        'provider_capture_id',
        'amount',
        'currency',
        'status',
        'payload',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payload' => 'array',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}
