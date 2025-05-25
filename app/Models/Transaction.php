<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id','yookassa_payment_id','amount','currency','status'];
    public function user() { return $this->belongsTo(User::class); }
}
