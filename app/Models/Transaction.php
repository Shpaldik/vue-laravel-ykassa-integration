<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'yookassa_payment_id',
        'amount',
        'currency',
        'status',
    ];

    protected $casts = [
        'amount'        => 'decimal:2',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
