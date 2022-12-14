<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRequest extends Model
{
    use HasFactory;
    protected $table = 'payment_requests';
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
