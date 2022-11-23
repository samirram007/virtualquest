<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpsLevelCommission extends Model
{
    use HasFactory;
    protected $fillable = ['scheme_id', 'level', 'commission'];
}
