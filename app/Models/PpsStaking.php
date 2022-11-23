<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpsStaking extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function investment()
    {
        return $this->belongsTo('App\Models\SelfInvestment','investment_id');
    }
}
